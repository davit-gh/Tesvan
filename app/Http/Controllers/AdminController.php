<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectObjective;
use App\Models\ProjectResult;
use App\Models\TechnologyTool;
use App\Models\ClientFeedback;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //

    public function index() {
        return view('admin/admin');
    }

    public function logout(Request $request) {
        
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login'));

    }

    public function projectList(Request $request){
        return view('admin/projects');
    }

    public function projectEdit($id){
        $data['project'] = Project::where("id",$id)->first();
        $data['project_objective'] = ProjectObjective::where('project_id',$id)->get();
        $data['project_result'] = ProjectResult::where('project_id',$id)->get();
        $data['technology_tool'] = TechnologyTool::where('project_id',$id)->get();
        $data['client_feedback'] = ClientFeedback::where('project_id',$id)->get();
        return view('admin/project-edit',$data);
    }

    public function projectListDatatable(Request $request){
        $project = Project::all();
        return DataTables::of($project)->addColumn('action','
            <a href="{{ route("project.edit",["id"=>$id]) }}" class="editItem" data-id="{{ $id }}"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a> <a href="javascript:void(0)" class="deleteItem" data-id="{{ $id }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
            ')->toJson();
    }

    public function storeProject(Request $request) {
   
        $user = Auth::user();

        $messages = [
            'project_name.required' => 'Project Name required!',
            'project_challenge.required'=>'Project Challenge required!',
            'project_overview.required'=>'Project Overview required!',
            'project_solution.required'=>'Solution required!',
            'project_logo.required'=>'Logo required!',
            'project_objective_desc.required'=>'Objective required!',
            'project_objective.required'=>'Objective required!',
            'project_objective.*.required'=>'Objective required!',
            'project_result.required'=>'Result required!',
            'project_result.*.required'=>'Result required!',
            'project_result_desc.required'=>'Result required!',
            'project_twu_desc.required'=>'Technology We Used Name required!',
            'project_twu_name.required'=>'Technology We Used Name required!',
            'project_twu_name.*.required'=>'Technology We Used Name required!',
            'project_twu_logo.required'=>'Technology We Used Logo required!',
            'project_twu_logo.*.required'=>'Technology We Used Logo required!',
            'project_cf_desc.required'=>'Client Feedback required!',
            'project_cf_feedback.required'=>'Client Feedback required!',
            'project_cf_photo.required'=>'Client Photo required!',
            'project_cf_name.required'=>'Client Name required!',
            'project_cf_website.required'=>'Client Website required!',
            'project_cf_feedback.*.required'=>'Client Feedback required!',
            'project_cf_photo.*.required'=>'Client Photo required!',
            'project_cf_name.*.required'=>'Client Name required!',
            'project_cf_website.*.required'=>'Client Website required!'
        ];

        $rule = [
            'project_name'=>'required',
            'project_challenge'=>'required',
            'project_overview'=>'required',
            'project_solution'=>'required',
            'project_logo'=>'required',
            'project_objective'=>'required',
            'project_objective_desc.required',
            'project_objective.*'=>'required',
            'project_result'=>'required',
            'project_result_desc'=>'required',
            'project_result.*'=>'required',
            'project_twu_desc'=>'required',
            'project_twu_name'=>'required',
            'project_twu_name.*'=>'required',
            'project_twu_logo'=>'required',
            'project_twu_logo.*'=>'required',
            'project_cf_desc'=>'required',
            'project_cf_feedback'=>'required',
            'project_cf_photo'=>'required',
            'project_cf_name'=>'required',
            'project_cf_website'=>'required',
            'project_cf_feedback.*'=>'required',
            'project_cf_photo.*'=>'required',
            'project_cf_name.*'=>'required',
            'project_cf_website.*'=>'required'
        ];

        $validator = Validator::make($request->all(),$rule,$messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            $p = new Project;
            $p->project_name = $request->project_name;
            $p->project_logo = "";
            $p->project_overview = $request->project_overview;
            $p->project_challenge = $request->project_challenge;
            $p->project_solution = $request->project_solution;
            $p->project_objective_desc = $request->project_objective_desc;
            $p->project_result_desc = $request->project_result_desc;
            $p->project_twu_desc = $request->project_twu_desc;
            $p->project_cf_desc = $request->project_cf_desc;
            $p->other_case = $request->other_cases;
            $p->user_id = $user->id;
            $p->save();

            if ($request->file("project_logo")){
                $ext = $request->file("project_logo")->getClientOriginalExtension();
                $file_size = $request->file("project_logo")->getSize();
                $file_name = date('YmdHis').rand(1,500).rand(501,1000).'.'.$ext;
                $path = 'uploads/images/project/logo/'.$p->id;
                $dir_upload = public_path($path);
                if (!file_exists($dir_upload)) {
                    mkdir($dir_upload, 0777, true);
                }
                        // upload file
                $request->file("project_logo")->move($dir_upload,$file_name);
                $f = Project::find($p->id);
                $f->project_logo = $file_name;
                $f->save();
            }

            if ($request->project_objective){
                if (count($request->project_objective)>0){
                    foreach ($request->project_objective as $key => $value) {
                        if ($request->project_objective[$key]!==""){
                            $po = new ProjectObjective;
                            $po->objective = $request->project_objective[$key];
                            $po->project_id = $p->id;
                            $po->save();
                        }
                    }
                }
            }

            if ($request->project_result){
                if (count($request->project_result)>0){
                    foreach ($request->project_result as $key => $value) {
                        if ($request->project_result[$key]!==""){
                            $pr = new ProjectResult;
                            $pr->result = $request->project_result[$key];
                            $pr->project_id = $p->id;
                            $pr->save();
                        }
                    }
                }
            }

            if ($request->project_twu_name){
                if (count($request->project_twu_name)>0){
                    foreach ($request->project_twu_name as $key => $value) {
                        if ($request->project_twu_name[$key]!==""){
                            $tt = new TechnologyTool;
                            $tt->name = $request->project_twu_name[$key];
                            $tt->logo = "";
                            $tt->project_id = $p->id;
                            $tt->save();

                            $ext = $request->file("project_twu_logo")[$key]->getClientOriginalExtension();
                            $file_size = $request->file("project_twu_logo")[$key]->getSize();
                            $file_name = date('YmdHis').rand(1,500).rand(501,1000).'.'.$ext;
                            $path = 'uploads/images/project/twu/'.$p->id;
                            $dir_upload = public_path($path);
                            if (!file_exists($dir_upload)) {
                                mkdir($dir_upload, 0777, true);
                            }

                            $request->file("project_twu_logo")[$key]->move($dir_upload,$file_name);
                            $ft = TechnologyTool::find($tt->id);
                            $ft->logo = $file_name;
                            $ft->save();
                        }
                    }
                }
            }

            if ($request->project_cf_feedback){
                if (count($request->project_cf_feedback)>0){
                    foreach ($request->project_cf_feedback as $key => $value) {
                        if ($request->project_cf_feedback[$key]!==""){
                            
                            $pr = new ClientFeedback;
                            $pr->client_feedback = $request->project_cf_feedback[$key];
                            $pr->client_photo = "";
                            $pr->client_name =  $request->project_cf_name[$key];
                            $pr->client_position = "";
                            $pr->client_website = $request->project_cf_website[$key];
                            $pr->project_id = $p->id;
                            $pr->save();

                            $ext = $request->file("project_cf_photo")[$key]->getClientOriginalExtension();
                            $file_size = $request->file("project_cf_photo")[$key]->getSize();
                            $file_name = date('YmdHis').rand(1,500).rand(501,1000).'.'.$ext;
                            $path = 'uploads/images/project/cf/'.$p->id;
                            $dir_upload = public_path($path);
                            if (!file_exists($dir_upload)) {
                                mkdir($dir_upload, 0777, true);
                            }

                            $request->file("project_cf_photo")[$key]->move($dir_upload,$file_name);
                            $f = ClientFeedback::find($pr->id);
                            $f->client_photo = $file_name;
                            $f->save();

                        }
                    }
                }
            }

            //$tt = new TechnologyTool;
            //$tt->save();
            \Session::flash('success', 'Succesfully added project!'); 
            return redirect(route('admin'))->with(['success' => 'Succesfully added project!']);

        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

    public function updateProject(Request $request) {
   
        $user = Auth::user();

        $messages = [
            'project_name.required' => 'Project Name required!',
            'project_challenge.required'=>'Project Challenge required!',
            'project_overview.required'=>'Project Overview required!',
            'project_solution.required'=>'Solution required!',
            'project_logo.required'=>'Logo required!',
            'project_objective_desc.required'=>'Objective required!',
            'project_objective.required'=>'Objective required!',
            'project_objective.*.required'=>'Objective required!',
            'project_result.required'=>'Result required!',
            'project_result.*.required'=>'Result required!',
            'project_result_desc.required'=>'Result required!',
            'project_twu_desc.required'=>'Technology We Used Name required!',
            'project_twu_name.required'=>'Technology We Used Name required!',
            'project_twu_name.*.required'=>'Technology We Used Name required!',
            'project_twu_logo.required'=>'Technology We Used Logo required!',
            'project_twu_logo.*.required'=>'Technology We Used Logo required!',
            'project_cf_desc.required'=>'Client Feedback required!',
            'project_cf_feedback.required'=>'Client Feedback required!',
            'project_cf_photo.required'=>'Client Photo required!',
            'project_cf_name.required'=>'Client Name required!',
            'project_cf_website.required'=>'Client Website required!',
            'project_cf_feedback.*.required'=>'Client Feedback required!',
            'project_cf_photo.*.required'=>'Client Photo required!',
            'project_cf_name.*.required'=>'Client Name required!',
            'project_cf_website.*.required'=>'Client Website required!'
        ];

        $rule = [
            'project_name'=>'required',
            'project_challenge'=>'required',
            'project_overview'=>'required',
            'project_solution'=>'required',
            'project_objective'=>'required',
            'project_objective_desc.required',
            'project_objective.*'=>'required',
            'project_result'=>'required',
            'project_result_desc'=>'required',
            'project_result.*'=>'required',
            'project_twu_desc'=>'required',
            'project_twu_name'=>'required',
            'project_twu_name.*'=>'required',
            'project_cf_desc'=>'required',
            'project_cf_feedback'=>'required',
            'project_cf_name'=>'required',
            'project_cf_website'=>'required',
            'project_cf_feedback.*'=>'required',
            'project_cf_name.*'=>'required',
            'project_cf_website.*'=>'required'
        ];

        $validator = Validator::make($request->all(),$rule,$messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            $p = Project::find($request->id);
            $p->project_name = $request->project_name;
            $p->project_overview = $request->project_overview;
            $p->project_challenge = $request->project_challenge;
            $p->project_solution = $request->project_solution;
            $p->project_objective_desc = $request->project_objective_desc;
            $p->project_result_desc = $request->project_result_desc;
            $p->project_twu_desc = $request->project_twu_desc;
            $p->project_cf_desc = $request->project_cf_desc;
            $p->other_case = $request->other_cases;
            $p->user_id = $user->id;
            $p->save();

            if ($request->file("project_logo")){
                $ext = $request->file("project_logo")->getClientOriginalExtension();
                $file_size = $request->file("project_logo")->getSize();
                $file_name = date('YmdHis').rand(1,500).rand(501,1000).'.'.$ext;
                $path = 'uploads/images/project/logo/'.$p->id;
                $dir_upload = public_path($path);
                if (!file_exists($dir_upload)) {
                    mkdir($dir_upload, 0777, true);
                }
                        // upload file
                $request->file("project_logo")->move($dir_upload,$file_name);
                $f = Project::find($p->id);
                $f->project_logo = $file_name;
                $f->save();
            }

            if ($request->project_objective){
                if (count($request->project_objective)>0){
                    foreach ($request->project_objective as $key => $value) {
                        if ($request->project_objective[$key]!==""){
                            $po = ProjectObjective::find($request->project_objective_id[$key]);
                            $po->objective = $request->project_objective[$key];
                            $po->project_id = $p->id;
                            $po->save();
                        }
                    }
                }
            }

            if ($request->project_result){
                if (count($request->project_result)>0){
                    foreach ($request->project_result as $key => $value) {
                        if ($request->project_result[$key]!==""){
                            $pr = ProjectResult::find($request->project_result_id[$key]);
                            $pr->result = $request->project_result[$key];
                            $pr->project_id = $p->id;
                            $pr->save();
                        }
                    }
                }
            }

            if ($request->project_twu_name){
                if (count($request->project_twu_name)>0){
                    foreach ($request->project_twu_name as $key => $value) {
                        if ($request->project_twu_name[$key]!==""){
                            
                            $tt = TechnologyTool::find($request->project_twu_id[$key]);
                            $tt->name = $request->project_twu_name[$key];
                            $tt->logo = "";
                            $tt->project_id = $p->id;
                            $tt->save();

                            if ($request->file("project_twu_logo")){
                                $ext = $request->file("project_twu_logo")[$key]->getClientOriginalExtension();
                                $file_size = $request->file("project_twu_logo")[$key]->getSize();
                                $file_name = date('YmdHis').rand(1,500).rand(501,1000).'.'.$ext;
                                $path = 'uploads/images/project/twu/'.$p->id;
                                $dir_upload = public_path($path);
                                if (!file_exists($dir_upload)) {
                                    mkdir($dir_upload, 0777, true);
                                }

                                $request->file("project_twu_logo")[$key]->move($dir_upload,$file_name);
                                $ft = TechnologyTool::find($tt->id);
                                $ft->logo = $file_name;
                                $ft->save();

                            }
                        }
                    }
                }
            }

            if ($request->project_cf_feedback){
                if (count($request->project_cf_feedback)>0){
                    foreach ($request->project_cf_feedback as $key => $value) {
                        if ($request->project_cf_feedback[$key]!==""){
                            
                            $pr = ClientFeedback::find($request->project_cf_id[$key]);
                            $pr->client_feedback = $request->project_cf_feedback[$key];
                            $pr->client_photo = "";
                            $pr->client_name =  $request->project_cf_name[$key];
                            $pr->client_position = "";
                            $pr->client_website = $request->project_cf_website[$key];
                            $pr->project_id = $p->id;
                            $pr->save();

                            if ($request->file("project_cf_photo")){
                                $ext = $request->file("project_cf_photo")[$key]->getClientOriginalExtension();
                                $file_size = $request->file("project_cf_photo")[$key]->getSize();
                                $file_name = date('YmdHis').rand(1,500).rand(501,1000).'.'.$ext;
                                $path = 'uploads/images/project/cf/'.$p->id;
                                $dir_upload = public_path($path);
                                if (!file_exists($dir_upload)) {
                                    mkdir($dir_upload, 0777, true);
                                }

                                $request->file("project_cf_photo")[$key]->move($dir_upload,$file_name);
                                $f = ClientFeedback::find($pr->id);
                                $f->client_photo = $file_name;
                                $f->save();

                            }
                        }
                    }
                }
            }

            \Session::flash('success', 'Succesfully updated project!'); 
            return redirect(route('project.list'))->with(['success' => 'Succesfully updated project!']);

        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

    public function deleteProject(Request $request) {
        try {
            $id = $request->id;      
            ProjectObjective::where('project_id',$id)->delete();
            ProjectResult::where('project_id',$id)->delete();
            TechnologyTool::where('project_id',$id)->delete();
            ClientFeedback::where('project_id',$id)->delete();
            Project::where('id',$id)->delete();
            \Session::flash('success', 'Succesfully deleted project!'); 
            return response()->json('success', 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

}
