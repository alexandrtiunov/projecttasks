<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){

        $projects = Project::all();

        return view('project',[
            'projects' => $projects,
        ]);
    }

    public function project(){

        $projects = Project::all();

        return view('project',[
            'projects' => $projects,
        ]);
    }

    public function task(){

        $tasks = Task::all();

        return view('task', [
            'tasks' => $tasks,
            ]);
    }

    public function detail(Request $request, $projectId, $id){

        $task = Task::find($id);

        return view('detail', [
          'task' => $task,
        ]);

    }
}
