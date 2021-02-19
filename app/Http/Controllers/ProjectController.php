<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

class ProjectController extends Controller
{

    public function index() {
        return view('project.project');
    }
}
