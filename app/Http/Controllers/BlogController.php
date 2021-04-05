<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectObjective;
use App\Models\ProjectResult;
use App\Models\TechnologyTool;
use App\Models\ClientFeedback;
use App\Models\Blog;

use Mail;

class BlogController extends Controller
{

    public function index() {
    	$data['blog'] = Blog::orderBy("id","desc")->with('user')->limit(4)->get();
        $data['blog_popular'] = Blog::orderBy("id","desc")->limit(3)->get();
        $data['blog_recent'] = Blog::orderBy("id","desc")->get();
        $data['pathimage'] = url("uploads/images/blogs");
        return view('blog.blog',$data);
    }

    public function detail($project_name) {

        $project_name = strtr($project_name, ["-"=>" "]);

    	$data['project'] = Project::whereRaw('LOWER(project_name) like "%'.$project_name.'%" ')->first();

        if (!$data['project']){
            abort(404);
        }

        $id = $data['project']->id;
    	$data['project_objective'] = ProjectObjective::where('project_id',$id)->get();
    	$data['project_result'] = ProjectResult::where('project_id',$id)->get();
    	$data['technology_tool'] = TechnologyTool::where('project_id',$id)->get();
    	$data['client_feedback'] = ClientFeedback::where('project_id',$id)->get();
    	$data['related'] = Project::where('id','!=',$id)->orderBy("id","desc")->limit(30)->get();

        return view('project.detail',$data);
    }
}
