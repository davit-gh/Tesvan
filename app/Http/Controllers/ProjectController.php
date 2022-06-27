<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectObjective;
use App\Models\ProjectResult;
use App\Models\TechnologyTool;
use App\Models\ClientFeedback;

use Mail;

class ProjectController extends Controller
{

    public function index() {
    	$data['project'] = Project::getList();
        return view('project.project',$data);
    }

    public function detail($project_name) {

        $project_name = strtr($project_name, ["-"=>" "]);
        $url_slug = Project::getUrl()->url_slug;
        if ($url_slug != null){
            $data['project'] = Project::whereRaw('LOWER(url_slug) like "%' . $project_name . '%" ')->first();
        } else {
            $data['project'] = Project::whereRaw('LOWER(project_name) like "%' . $project_name . '%" ')->first();
        }



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
