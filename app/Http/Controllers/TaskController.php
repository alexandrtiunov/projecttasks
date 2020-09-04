<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\UploadedPath\UploadResource;

class TaskController extends Controller
{
    public function addTask(Request $request){

        $task = $this->validate(request(),[
            "name" => "required",
            "task" => "required",
            "project_id" => "required",
        ]);
        $task['user_id'] = Auth::user()->id;

        if ($request->hasFile('img_path')) {
            $file = $request->file('img_path');
            $task['img_path'] = UploadResource::getUniqueName($file); // получение уникального имени файла
            $file->move(public_path() . '/img/taskfiles', $task['img_path']);
        }

        if($task){
            Task::create($task);
            return back();
        }
    }

    public function editTask($id){

        return back();
    }

    public function updateTask(Request $request, $id){

        $task = Task::find($id);

        $this->validate(request(), [
            "name" => "required",
            "task" => "required",
            "project_id" => "required",
        ]);

        if ($request->hasFile('img_path')) {
            $file = $request->file('img_path');
            $task['img_path'] = UploadResource::getUniqueName($file); // получение уникального имени файла
            $file->move(public_path() . '/img/taskfiles', $task['img_path']);
        }

        $task['user_id'] = Auth::user()->id;

        $task->name = $request->get('name');
        $task->task = $request->get('task');
        $task->project_id = $request->get('project_id');
        $task->task_status_id = $request->get('task_status_id');
        $task->user_id = $task['user_id'];

        $img = $request->get('img_path');
        if(isset($img)){
            $task->img_path = $img;
            $task->save();
        }
        $task->save();

        return back();
    }

    public function deleteTask($id){

        $task = Task::find($id)->first();

        if($task->img_path != null){
            unlink(public_path() . '/img/taskfiles/' . $task->img_path);
        }

        $task->delete();

        return back();
    }

}
