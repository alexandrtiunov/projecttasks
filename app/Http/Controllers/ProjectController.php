<?php

namespace App\Http\Controllers;

use App\AddUserInProject;
use App\Project;
use App\Task;
use App\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function addProject(Request $request){

        $project = $this->validate(request(),[
            "name" => "required",
        ]);
        $project['user_id'] = Auth::user()->id;

        if($project){
            Project::create($project);
            return back();
        }
    }

    public function editProject($id){

        $project = Project::find($id);
        $tasks = Task::where('project_id', $id)->get();
        $taskStatus = TaskStatus::all();

        return view('task', [
            'project' => $project,
            'tasks' => $tasks,
            'taskStatus' => $taskStatus,
        ]);
    }

    public function updateProject(Request $request, $id){

        $project = Project::find($id);
        $this->validate(request(), [
            "name" => "required",
        ]);

        $project['user_id'] = Auth::user()->id;
        $project->name = $request->get('name');
        $project->save();

        return back();
    }

    public function deleteProject($id){

        $projects = Project::find($id);
        $task = Task::where('project_id', $projects->id)->get();
        $tasks = Task::where('project_id', $id);

        foreach ($task as $value){
            if($value->img_path != null){
                unlink(public_path() . '/img/taskfiles/' . $value->img_path);
            }
        }

        $tasks->delete();
        $projects->delete();

        return back();
    }

    public function addUserInProject(Request $request, $user_id, $project_id, $task_id = null){

//        dd($request);
        $newUserInProject = $this->validate(request(),[
            "user_id" => "required",
            "project_id" => "required",
        ]);

        if($newUserInProject){
            AddUserInProject::create($newUserInProject);
            return back();
        }
    }
}
