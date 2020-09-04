<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => '/', 'middleware' => ['web', 'auth']], function () {
//    Route::get('/', 'IndexController@index');
    Route::get('/', 'IndexController@project');

    Route::get('/task', 'IndexController@task');
    Route::get('/{idproject}/task/{id}', 'IndexController@detail');

    Route::post('/task', 'TaskController@addTask');
    Route::get('/task/{id}/editTask', 'TaskController@editTask');
    Route::post('/task/{id}/updateTask', 'TaskController@updateTask');
    Route::post('/task/{id}', 'TaskController@deleteTask');


    Route::post('/project', 'ProjectController@addProject');
    Route::get('/project/{id}', 'ProjectController@editProject');
    Route::post('/project/{id}/addnewuser', 'ProjectController@addUserInProject');
    Route::post('/project/{id}/updateproject', 'ProjectController@updateProject');
    Route::post('/project/{id}', 'ProjectController@deleteProject');
    });

Route::group(['prefix' => '/admin', 'middleware' => ['web', 'auth']], function () {
//    Route::get('/', 'Admin\IndexController@index');
    Route::get('/', 'Admin\IndexController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
