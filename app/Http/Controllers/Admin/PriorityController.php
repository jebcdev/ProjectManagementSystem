<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Priority\StorePriorityRequest;
use App\Http\Requests\Priority\UpdatePriorityRequest;
use App\Models\Priority;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $data = Priority::query();
            $totalResults = null;

            if ($request->filled('search')) {
                $searchTerm = strtolower($request->search);

                // Obtenemos los campos desde el modelo 
                $searchableFields = (new Priority)->getFillable();

                $data->where(function ($query) use ($searchTerm, $searchableFields) {
                    foreach ($searchableFields as $field) {
                        $query->orWhereRaw("LOWER({$field}) LIKE ?", ["%{$searchTerm}%"]);
                    }
                });

                $totalResults = $data->count();
            }

            $data = $data->orderBy('name', 'asc');

            return view('modules.admin.priorities.index', [
                'priorities' => $data->paginate(10)->appends(['search' => $request->search]),
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
            $priority = new Priority();
            return view('modules.admin.priorities.create', [
                'priority' => $priority
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePriorityRequest $request)
    {
        try {
            $data = $request->validated();

            $priority = Priority::create($data);

            $message = __('Priority Created Successfully') . ': ' . $priority->name;

            return to_route('admin.priorities.index')->with('sessionMessage', $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Priority $priority)
    {
        try {
            return view('modules.admin.priorities.edit', [
                'priority' => $priority
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePriorityRequest $request, Priority $priority)
    {
        try {
            $data = $request->validated();

            $priority->update($data);

            $message = __('Priority Updated Successfully') . ': ' . $priority->name;

            return to_route('admin.priorities.index')->with('sessionMessage', $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Priority $priority)
    {
        try {
            $priority->delete();

            $message = __('Priority Deleted Successfully') . ': ' . $priority->name;

            return to_route('admin.priorities.index')->with('sessionMessage', $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
