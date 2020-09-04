<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'task', 'project_id', 'task_status_id', 'user_id', 'img_path'];


    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function taskStatus()
    {
        return $this->belongsTo('App\TaskStatus');
    }

    public function addUserInProject()
    {
        return $this->belongsToMany('App\AddUserInProject');
    }
}
