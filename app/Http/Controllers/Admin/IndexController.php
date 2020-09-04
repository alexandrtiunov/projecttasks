<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){

        $users = User::all();

        return view('admin.index', [
            'users' => $users,
        ]);
    }
}
