<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Status\StoreStatusRequest;
use App\Http\Requests\Status\UpdateStatusRequest;
use App\Models\Status;


class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $statuses = Status::query()
                ->orderBy('name', 'ASC')
                ->get();

            return view('modules.admin.statuses.index', [
                'statuses' => $statuses
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
            $status = new Status();
            return view('modules.admin.statuses.create', [
                'status' => $status
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatusRequest $request)
    {
        try {
            $data = $request->validated();

            $status = Status::create($data);

            $message = __('Status Created Successfully') . ': ' . $status->name;

            return to_route('admin.statuses.index')->with('sessionMessage', $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {
        try {
            return view('modules.admin.statuses.edit', [
                'status' => $status
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusRequest $request, Status $status)
    {
        try {
            $data = $request->validated();

            $status->update($data);

            $message = __('Status Updated Successfully') . ': ' . $status->name;

            return to_route('admin.statuses.index')->with('sessionMessage', $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        try {
            $status->delete();

            $message = __('Status Deleted Successfully') . ': ' . $status->name;

            return to_route('admin.statuses.index')->with('sessionMessage', $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
