<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Priority;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        try {
            if (Project::count() == 0) {
                return redirect()->route('projects.index')->with('errorMessage', __('You Need To Create A Project First'));
            }

            $data = Task::query();
            $totalResults = null;

            if ($request->filled('search')) {
                $searchTerm = strtolower($request->search);

                // Obtenemos los campos directamente del modelo Task
                $searchableFields = (new Task)->getFillable();

                $data->where(function ($query) use ($searchTerm, $searchableFields) {
                    // Búsqueda en los campos de Project
                    foreach ($searchableFields as $field) {
                        $query->orWhereRaw("LOWER({$field}) LIKE ?", ["%{$searchTerm}%"]);
                    }

                    // Búsqueda en los nombres de las relaciones
                    $query->orWhereHas('project', function ($q) use ($searchTerm) {
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
                'project',
                'assignedUser',
                'creator',
                'updater',
                'status',
                'priority',
            ])->orderBy('name', 'asc');

            return view('modules.tasks.index', [
                'tasks' => $data->paginate(10)->appends(['search' => $request->search]),
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
            if (Project::count() == 0) {
                return redirect()->route('projects.index')->with('errorMessage', __('You Need To Create A Project First'));
            }

            $task = new Task();
            $task->load([
                'project',
                'assignedUser',
                'creator',
                'updater',
                'status',
                'priority',
            ]);
            $projects = Project::query()
                ->orderBy('name', 'ASC')
                ->get();

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



            return view('modules.tasks.create', [
                'task' => $task,
                'projects' => $projects,
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
    public function store(StoreTaskRequest $request)
    {
        try {
            // Valida los datos de la solicitud
            $data = $request->validated();

            $imagePath = "";

            if ($request->hasFile('image_path')) {

                $imagePath = $request->file('image_path')->store('assets/img/tasks', 'public');


                $data['image_path'] =  $imagePath;
                // dd($imagePath);

            }

            // Crea el registro
            $task = Task::create($data);

            // Mensaje de éxito
            $message = __('Task Created Successfully') . ': ' . $task->name;

            return to_route('tasks.index')->with('sessionMessage', $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        try {
            if (Project::count() == 0) {
                return redirect()->route('projects.index')->with('errorMessage', __('You Need To Create A Project First'));
            }

            $task
                ->load([
                    'creator',
                    'updater',
                    'status',
                    'priority',
                ])
                ->get();

            return view('modules.tasks.show', [
                'task' => $task,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        try {
            try {
                $task->load([
                    'project',
                    'assignedUser',
                    'creator',
                    'updater',
                    'status',
                    'priority',
                ]);

                $projects = Project::query()
                    ->orderBy('name', 'ASC')
                    ->get();

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



                return view('modules.tasks.edit', [
                    'task' => $task,
                    'projects' => $projects,
                    'users' => $users,
                    'statuses' => $statuses,
                    'priorities' => $priorities,
                ]);
            } catch (\Throwable $th) {
                throw $th;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        try {
            // Verifica si el usuario tiene permisos para actualizar el proyecto
            if ($task->created_by != Auth::id() && !Auth::user()->isAdmin) {
                return to_route('projects.index')->with('errorMessage', __('You Are Not Authorized To View This Task'));
            }

            // Valida los datos de la solicitud
            $data = $request->validated();

            // Manejo de la imagen
            if ($request->hasFile('image_path')) {
                // Borra la imagen anterior si existe
                if ($task->image_path && Storage::disk('public')->exists($task->image_path)) {
                    Storage::disk('public')->delete($task->image_path);
                }

                // Almacena la nueva imagen
                $newImagePath = $request->file('image_path')->store('assets/img/tasks', 'public');
                $data['image_path'] = $newImagePath;
            }

            // Actualiza el proyecto con los nuevos datos
            $task->update($data);

            // Mensaje de éxito
            $message = __('Task Updated Successfully') . ': ' . $task->name;

            return to_route('tasks.show', $task)->with('sessionMessage', $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            // Verifica si el usuario tiene permisos para eliminar el proyecto
            if ($task->created_by != Auth::id() && !Auth::user()->isAdmin) {
                return to_route('tasks.index')->with('errorMessage', __('You Are Not Authorized To Delete This Task'));
            }

            // Borra la imagen si existe
            if ($task->image_path && Storage::disk('public')->exists($task->image_path)) {
                Storage::disk('public')->delete($task->image_path);
            }

            // Elimina el proyecto
            $task->delete();

            // Mensaje de éxito
            $message = __('Project Deleted Successfully') . ': ' . $task->name;

            return to_route('tasks.index')->with('sessionMessage', $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
