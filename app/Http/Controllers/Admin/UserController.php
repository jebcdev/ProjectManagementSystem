<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $data = User::query();
            $totalResults = null;

            if ($request->filled('search')) {
                $searchTerm = strtolower($request->search);


                // Obtenemos los campos desde el modelo 
                $searchableFields = (new User)->getFillable();



                $data->where(function ($query) use ($searchTerm, $searchableFields) {
                    foreach ($searchableFields as $field) {
                        $query->orWhereRaw("LOWER({$field}) LIKE ?", ["%{$searchTerm}%"]);
                    }
                });

                $totalResults = $data->count();
            }

            $data = $data->orderBy('name', 'asc');

            return view('modules.admin.users.index', [
                'users' => $data->paginate(10)->appends(['search' => $request->search]),
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
            $user = new User();
            return view('modules.admin.users.create', [
                'user' => $user
            ]);
            //code...
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $data = $request->validated();

            $data['password'] = Hash::make($data['password']);

            $user=User::create($data);

            $message = __('User Created Successfully') . ': ' . $user->name;

            return to_route('admin.users.index')->with('sessionMessage', $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        try {

            return view('modules.admin.users.edit', [
                'user' => $user
            ]);
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            
            $data = $request->validated();

            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            $user->update($data);
            

            $message = __('User Updated Successfully') . ': ' . $user->name;

            return to_route('admin.users.index')->with('sessionMessage', $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            $message = __('User Deleted Successfully') . ': ' . $user->name;

            return to_route('admin.users.index')->with('sessionMessage', $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
