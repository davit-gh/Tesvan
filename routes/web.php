<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/privacy', [
    'uses' => 'HomeController@privacy',
    'as' => 'privacy'
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

Route::get('/education', [
    'uses' => 'EducationController@index',
    'as' => 'education'
]);
Route::get('/education/{education_category}', [
    'uses' => 'EducationController@list',
    'as' => 'education.list'
]);
Route::get('/education/{education_category}/{education}', [
    'uses' => 'EducationController@detail',
    'as' => 'education.detail'
]);

Route::get('/blog/{name}', [
    'uses' => 'BlogController@detail',
    'as' => 'blog.detail'
]);

Route::get('/blogs', [
    'uses' => 'BlogController@index',
    'as' => 'blogs'
]);

Route::get('/admin/logout', [
    'uses' => 'AdminController@logout',
    'as' => 'admin.logout'
]);

Route::get('/team', [
    'uses' => 'HomeController@teams',
    'as' => 'teams'
]);

Route::get('team/cv/{file_name}', [
    'uses' => 'HomeController@teamsCv',
    'as' => 'team.cv'
]);

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [
        'uses' => 'AdminController@index',
        'as' => 'admin'
    ]);

    Route::get('/create-team', [
        'uses' => 'AdminController@createTeam',
        'as' => 'create.team'
    ]);

    Route::get('/team-list', [
        'uses' => 'AdminController@teamList',
        'as' => 'team.list'
    ]);

    Route::get('/team-dt', [
        'uses' => 'AdminController@teamListDatatable',
        'as' => 'team.list.dt'
    ]);

    Route::get('/project-list', [
        'uses' => 'AdminController@projectList',
        'as' => 'project.list'
    ]);

    Route::get('/project-edit/{id}', [
        'uses' => 'AdminController@projectEdit',
        'as' => 'project.edit'
    ]);

    Route::get('/team-edit/{id}', [
        'uses' => 'AdminController@teamEdit',
        'as' => 'team.edit'
    ]);

    Route::get('/projects-dt', [
        'uses' => 'AdminController@projectListDatatable',
        'as' => 'project.list.dt'
    ]);

    Route::post('/storeProject', [
        'uses' => 'AdminController@storeProject',
        'as' => 'project.store'
    ]);

    Route::post('/storeTeam', [
        'uses' => 'AdminController@storeTeam',
        'as' => 'team.store'
    ]);

    Route::post('/updateProject', [
        'uses' => 'AdminController@updateProject',
        'as' => 'project.update'
    ]);

    Route::post('/updateTeam', [
        'uses' => 'AdminController@updateTeam',
        'as' => 'team.update'
    ]);

    Route::post('/deleteProject', [
        'uses' => 'AdminController@deleteProject',
        'as' => 'project.delete'
    ]);

    Route::post('/deleteTeam', [
        'uses' => 'AdminController@deleteTeam',
        'as' => 'team.delete'
    ]);

    Route::post('/deleteEntity', [
        'uses' => 'AdminController@deleteEntity',
        'as' => 'project.delete.entity'
    ]);

    Route::get('/job_applications', [
        'uses' => 'AdminController@jobApplications',
        'as' => 'job_applications.index'
    ]);

    Route::get('/job_applications/data', [
        'uses' => 'JobController@data',
        'as' => 'job_applications.data'
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

    Route::get('/admin/category/index', [
        'uses' => 'AdminController@categories',
        'as' => 'admin.category.index'
    ]);
    Route::get('/admin/category/create', [
        'uses' => 'AdminController@categoryCreate',
        'as' => 'admin.category.create'
    ]);
    Route::get('/category-edit/{id}', [
        'uses' => 'AdminController@categoryEdit',
        'as' => 'category.edit'
    ]);
    Route::get('/category-dt', [
        'uses' => 'AdminController@categoryDatatable',
        'as' => 'category.dt'
    ]);
    Route::post('/storeCategory', [
        'uses' => 'AdminController@storeCategory',
        'as' => 'category.store'
    ]);
    Route::post('/updateCategory', [
        'uses' => 'AdminController@updateCategory',
        'as' => 'category.update'
    ]);
    Route::post('/deleteCategory', [
        'uses' => 'AdminController@deleteCategory',
        'as' => 'category.delete'
    ]);

    Route::get('/admin/education-category/index', [
        'uses' => 'AdminController@educationCategories',
        'as' => 'admin.education-categories.index'
    ]);
    Route::get('/admin/education-category-dt', [
        'uses' => 'AdminController@educationCategoryDatatable',
        'as' => 'education-category.dt'
    ]);
    Route::get('/admin/education-category/create', [
        'uses' => 'AdminController@educationCategoryCreate',
        'as' => 'admin.education-category.create'
    ]);
    Route::post('/storeEducationCategory', [
        'uses' => 'AdminController@storeEducationCategory',
        'as' => 'admin.education-category.store'
    ]);
    Route::get('/education-category-edit/{id}', [
        'uses' => 'AdminController@educationCategoryEdit',
        'as' => 'admin.education-category.edit'
    ]);
    Route::post('/updateEducationCategory', [
        'uses' => 'AdminController@updateEducationCategory',
        'as' => 'admin.education-category.update'
    ]);
    Route::post('/deleteEducationCategory', [
        'uses' => 'AdminController@deleteEducationCategory',
        'as' => 'admin.education-category.delete'
    ]);

    Route::get('/admin/education/index', [
        'uses' => 'AdminController@educations',
        'as' => 'admin.educations.index'
    ]);
    Route::get('/admin/education-dt', [
        'uses' => 'AdminController@educationDatatable',
        'as' => 'education.dt'
    ]);
    Route::get('/admin/education/create', [
        'uses' => 'AdminController@educationCreate',
        'as' => 'admin.education.create'
    ]);
    Route::post('/storeEducation', [
        'uses' => 'AdminController@storeEducation',
        'as' => 'admin.education.store'
    ]);
    Route::get('/education-edit/{id}', [
        'uses' => 'AdminController@educationEdit',
        'as' => 'admin.education.edit'
    ]);
    Route::post('/updateEducation', [
        'uses' => 'AdminController@updateEducation',
        'as' => 'admin.education.update'
    ]);
    Route::post('/deleteEducation', [
        'uses' => 'AdminController@deleteEducation',
        'as' => 'admin.education.delete'
    ]);

    Route::post('upload', [
        'uses' => 'StorageController@upload',
        'as' => 'admin.upload',
    ]);
});


Route::get('loc/lang/{locale}', 'LocalizationController@index');
