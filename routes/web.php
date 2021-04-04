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



Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home'
]);

Route::post('/', [
    'uses' => 'HomeController@ContactUsForm',
    'as' => 'home'
]);

Route::get('/job', [
    'uses' => 'JobController@index',
    'as' => 'job'
]);

Route::post('/job', [
    'uses' => 'JobController@JobApply',
    'as' => 'job'
]);

Route::get('/courses', [
    'uses' => 'CoursesController@index',
    'as' => 'courses'
]);

Route::post('/courses', [
    'uses' => 'CoursesController@CoursesRegister',
    'as' => 'courses'
]);

Route::get('/projects', [
    'uses' => 'ProjectController@index',
    'as' => 'projects'
]);

Route::get('/project/{project_name}', [
    'uses' => 'ProjectController@detail',
    'as' => 'project.detail'
]);

Route::get('/blogs', [
    'uses' => 'BlogController@index',
    'as' => 'blogs'
]);

Route::get('/admin/logout', [
    'uses' => 'AdminController@logout',
    'as' => 'admin.logout'
]);

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [
        'uses' => 'AdminController@index',
        'as' => 'admin'
    ]);

    Route::get('/project-list', [
        'uses' => 'AdminController@projectList',
        'as' => 'project.list'
    ]);

    Route::get('/project-edit/{id}', [
        'uses' => 'AdminController@projectEdit',
        'as' => 'project.edit'
    ]);

    Route::get('/projects-dt', [
        'uses' => 'AdminController@projectListDatatable',
        'as' => 'project.list.dt'
    ]);

    Route::post('/storeProject', [
        'uses' => 'AdminController@storeProject',
        'as' => 'project.store'
    ]);

    Route::post('/updateProject', [
        'uses' => 'AdminController@updateProject',
        'as' => 'project.update'
    ]);

    Route::post('/deleteProject', [
        'uses' => 'AdminController@deleteProject',
        'as' => 'project.delete'
    ]);

    Route::post('/deleteEntity', [
        'uses' => 'AdminController@deleteEntity',
        'as' => 'project.delete.entity'
    ]);

    Route::get('/admin/blog/index', [
        'uses' => 'AdminController@blogs',
        'as' => 'admin.blog.index'
    ]);

    Route::get('/admin/blog/create', [
        'uses' => 'AdminController@blogCreate',
        'as' => 'admin.blog.create'
    ]);

    Route::get('/blog-edit/{id}', [
        'uses' => 'AdminController@blogEdit',
        'as' => 'blog.edit'
    ]);

    Route::get('/blog-dt', [
        'uses' => 'AdminController@blogDatatable',
        'as' => 'blog.dt'
    ]);

    Route::post('/storeBlog', [
        'uses' => 'AdminController@storeBlog',
        'as' => 'blog.store'
    ]);

    Route::post('/updateBlog', [
        'uses' => 'AdminController@updateBlog',
        'as' => 'blog.update'
    ]);

    Route::post('/deleteBlog', [
        'uses' => 'AdminController@deleteBlog',
        'as' => 'blog.delete'
    ]);

    Route::post('/deleteEntityBlog', [
        'uses' => 'AdminController@deleteEntityBlog',
        'as' => 'blog.delete.entity'
    ]);

});


Route::get('lang/{locale}', 'LocalizationController@index');