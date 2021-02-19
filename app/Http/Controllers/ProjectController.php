<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

class ProjectController extends Controller
{

    public function index() {
        return view('project.project');
    }

    public function detail($id) {
        return view('project.detail');
    }
}
