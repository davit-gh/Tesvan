<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectObjective;
use App\Models\ProjectResult;
use App\Models\TechnologyTool;
use App\Models\ClientFeedback;

use Mail;

class EducationController extends Controller
{

    public function index() {
    	$data['project'] = Project::getList();
        return view('education.education',$data);
    }

    public function list($project_name) {

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

        return view('education.list',$data);
    }
    
}