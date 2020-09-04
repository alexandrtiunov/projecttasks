<?php

namespace App\Providers;

use App\AddUserInProject;
use Illuminate\Support\ServiceProvider;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $users = User::all();
        $userForProjects = AddUserInProject::all();


        view()->share([
            'users' => $users,
            'userForProjects' => $userForProjects,

        ]);
    }
}
