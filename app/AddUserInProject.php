<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddUserInProject extends Model
{

    protected $fillable = ['project_id', 'user_id', 'task_id'];

    public function project()
    {
        return $this->hasMany('App\Project');
    }

    public function user()
    {
        return $this->hasMany('App\User');
    }

    public function task()
    {
        return $this->hasMany('App\Task');
    }
}
