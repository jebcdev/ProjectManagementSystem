<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Http\Request;

class _SiteController extends Controller
{
    public function __invoke()
    {
        try {
            return to_route('dashboard');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function dashboard()
    {
        try {

            $projects = Project::all();
            $tasks = Task::all();
            $statuses=Status::all();
            $priorities=Priority::all();

            return view('modules._dashboard.index', [
                'projects' => $projects,
                'tasks' => $tasks,
                'statuses' => $statuses,
                'priorities' => $priorities,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
