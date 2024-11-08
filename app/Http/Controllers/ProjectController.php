<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Models\Priority;
use App\Models\Project;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $data = Project::query();
            $totalResults = null;
    
            if ($request->filled('search')) {
                $searchTerm = strtolower($request->search);
    
                // Obtenemos los campos directamente del modelo Project
                $searchableFields = (new Project)->getFillable();
    
                $data->where(function ($query) use ($searchTerm, $searchableFields) {
                    // Búsqueda en los campos de Project
                    foreach ($searchableFields as $field) {
                        $query->orWhereRaw("LOWER({$field}) LIKE ?", ["%{$searchTerm}%"]);
                    }
    
                    // Búsqueda en los nombres de las relaciones
                    $query->orWhereHas('creator', function ($q) use ($searchTerm) {
                        $q->whereRaw("LOWER(name) LIKE ?", ["%{$searchTerm}%"]);
                    })
                    ->orWhereHas('status', function ($q) use ($searchTerm) {
                        $q->whereRaw("LOWER(name) LIKE ?", ["%{$searchTerm}%"]);
                    })
                    ->orWhereHas('priority', function ($q) use ($searchTerm) {
                        $q->whereRaw("LOWER(name) LIKE ?", ["%{$searchTerm}%"]);
                    });
                });
    
                $totalResults = $data->count();
            }
    
            $data = $data->with([
                'creator',
                'updater',
                'status',
                'priority',
            ])->orderBy('name', 'asc');
    
            return view('modules.projects.index', [
                'projects' => $data->paginate(10)->appends(['search' => $request->search]),
                'totalResults' => $totalResults
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $users = User::query()
                ->where('id', '!=', Auth::id())
                ->orderBy('name', 'ASC')
                ->get();

            $statuses = Status::query()
                ->orderBy('name', 'ASC')
                ->get();

            $priorities = Priority::query()
                ->orderBy('name', 'ASC')
                ->get();

            $project = new Project();

            $project
                ->load([
                    'creator',
                    'updater',
                    'status',
                    'priority',
                ])
                ->get();

            return view('modules.projects.create', [
                'project' => $project,
                'users' => $users,
                'statuses' => $statuses,
                'priorities' => $priorities,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        try {
            // Valida los datos de la solicitud
            $data = $request->validated();

            $imagePath = "";

            if ($request->hasFile('image_path')) {

                $imagePath = $request->file('image_path')->store('assets/img/projects', 'public');


                $data['image_path'] =  $imagePath;
                // dd($imagePath);

            }

            // Crea el proyecto con los datos validados
            $project = Project::create($data);

            // Mensaje de éxito
            $message = __('Project Created Successfully') . ': ' . $project->name;

            return to_route('projects.index')->with('sessionMessage', $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        try {


            $project
                ->load([
                    'creator',
                    'updater',
                    'status',
                    'priority',
                ])
                ->get();

            return view('modules.projects.show', [
                'project' => $project,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        try {

            if ($project->created_by != Auth::id() && !Auth::user()->isAdmin) {
                return to_route('projects.index')->with('errorMessage', __('You Are Not Authorized To View This Project'));
            }

            $users = User::query()
                ->where('id', '!=', Auth::id())
                ->orderBy('name', 'ASC')
                ->get();

            $statuses = Status::query()
                ->orderBy('name', 'ASC')
                ->get();

            $priorities = Priority::query()
                ->orderBy('name', 'ASC')
                ->get();

            $project
                ->load([
                    'creator',
                    'updater',
                    'status',
                    'priority',
                ])
                ->get();

            return view('modules.projects.edit', [
                'project' => $project,
                'users' => $users,
                'statuses' => $statuses,
                'priorities' => $priorities,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        try {
            // Verifica si el usuario tiene permisos para actualizar el proyecto
            if ($project->created_by != Auth::id() && !Auth::user()->isAdmin) {
                return to_route('projects.index')->with('errorMessage', __('You Are Not Authorized To View This Project'));
            }

            // Valida los datos de la solicitud
            $data = $request->validated();

            // Manejo de la imagen
            if ($request->hasFile('image_path')) {
                // Borra la imagen anterior si existe
                if ($project->image_path && Storage::disk('public')->exists($project->image_path)) {
                    Storage::disk('public')->delete($project->image_path);
                }

                // Almacena la nueva imagen
                $newImagePath = $request->file('image_path')->store('assets/img/projects', 'public');
                $data['image_path'] = $newImagePath;
            }

            // Actualiza el proyecto con los nuevos datos
            $project->update($data);

            // Mensaje de éxito
            $message = __('Project Updated Successfully') . ': ' . $project->name;

            return to_route('projects.show', $project)->with('sessionMessage', $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            // Verifica si el usuario tiene permisos para eliminar el proyecto
            if ($project->created_by != Auth::id() && !Auth::user()->isAdmin) {
                return to_route('projects.index')->with('errorMessage', __('You Are Not Authorized To Delete This Project'));
            }
        
            // Borra la imagen del proyecto si existe
            if ($project->image_path && Storage::disk('public')->exists($project->image_path)) {
                Storage::disk('public')->delete($project->image_path);
            }
        
            // Elimina las imágenes y las tareas relacionadas
            foreach ($project->tasks as $task) {
                if ($task->image_path && Storage::disk('public')->exists($task->image_path)) {
                    Storage::disk('public')->delete($task->image_path);
                }
                $task->delete();
            }
        
            // Elimina el proyecto
            $project->delete();
        
            // Mensaje de éxito
            $message = __('Project Deleted Successfully') . ': ' . $project->name;
        
            return to_route('projects.index')->with('sessionMessage', $message);
        } catch (\Throwable $th) {
            throw $th;
        }
        
        
    }
}
