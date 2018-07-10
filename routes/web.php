<?php

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

Route::get('/', function () {
    return view('home');
});

Route::get('user', 'UserController@show');

Route::post('logout', 'UserController@logout');

Route::get('panel', 'PanelController@getProjects');

Route::post('addProject', 'PanelController@addProjects');

Route::post('panel', 'UserController@ajaxRequestPost');

Route::post('deleteproject', 'PanelController@deleteProjects');

Route::get('project', 'ProjectController@displayProject');

Route::post('project', 'ProjectController@getProject');

Route::post('addDiscussion', 'ProjectController@addDiscussion');

//Route::get('addDiscussion', 'ProjectController@addDiscussion');
