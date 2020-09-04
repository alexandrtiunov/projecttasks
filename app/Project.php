<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable=['name', 'user_id'];

    public function task()
    {
        return $this->hasMany('App\Task');
    }

    public function addUserInProject()
    {
        return $this->belongsToMany('App\AddUserInProject');
    }
}
