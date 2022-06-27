<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Blog;
use App\Models\Category;
use App\Models\ClientFeedback;
use App\Models\Education;
use App\Models\EducationCategory;
use App\Models\Project;
use App\Models\ProjectObjective;
use App\Models\ProjectResult;
use App\Models\Team;
use App\Models\TechnologyTool;
use App\Services\EdJSParser;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin/admin');
    }

    public function createTeam()
    {
        return view('admin/create-team');
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login'));
    }

    public function projectList(Request $request)
    {
        return view('admin/projects');
    }

    public function teamList(Request $request)
    {
        return view('admin/teams');
    }

    public function jobApplications(Request $request)
    {
        return view('admin.job_applications.index');
    }

    public function blogs(Request $request)
    {
        return view('admin/blogs');
    }

    public function blogCreate(Request $request)
    {
        $data["categories"] = Category::all();
        return view('admin/blogcreate', $data);
    }

    public function blogDatatable(Request $request)
    {
        $blog = Blog::orderBy("id", "desc")->get();
        return DataTables::of($blog)
            ->editColumn('title', function ($d) {
                return $this->limitWord($d->title);
            })
            ->editColumn('description', function ($d) {
                return $this->limitWord($d->description);
            })
            ->addColumn('category', function ($d) {
                $category_name = "";
                $c = Category::where("id", $d->category_id)->first();
                if ($c) {
                    $category_name = $c->name;
                }
                return $this->limitWord($category_name);
            })
            ->editColumn('image', function ($d) {
                return "<img width='100' height='100' src='" . url('uploads/images/blogs/' . $d->id . '/resize_' . $d->image) . "'/>";
            })
            ->editColumn('status', function ($d) {
                return $this->limitWord($d->status);
            })
            ->editColumn('published_date', function ($d) {
                return $this->limitWord($d->published_date);
            })
            ->addColumn('public_view', function ($d) {
                return $d->view;
            })
            ->addColumn('created_by', function ($d) {
                return $d->created_by;
            })
            ->addColumn('action', '
            <a href="{{ route("blog.edit",["id"=>$id]) }}" class="editItem" data-id="{{ $id }}"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a> <a href="javascript:void(0)" class="deleteItem" data-id="{{ $id }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
            ')
            ->rawColumns(['image', 'action', 'description'])
            ->make(true);
    }

    public function projectEdit($id)
    {
        $data['project'] = Project::where("id", $id)->first();
        $data['project_objective'] = ProjectObjective::where('project_id', $id)->get();
        $data['project_result'] = ProjectResult::where('project_id', $id)->get();
        $data['technology_tool'] = TechnologyTool::where('project_id', $id)->get();
        $data['client_feedback'] = ClientFeedback::where('project_id', $id)->get();
        return view('admin/project-edit', $data);
    }

    public function teamEdit($id)
    {
        $data['team'] = Team::where("id", $id)->first();
        return view('admin/team-edit', $data);
    }


    private function limitWord($word)
    {
        $limit = 30;
        if (strlen($word) > $limit) {
            return substr($word, 0, $limit) . " ...";
        }
        return $word;
    }

    public function projectListDatatable(Request $request)
    {
        $project = Project::orderBy("id", "desc")->get();
        return DataTables::of($project)
            ->editColumn('project_name', function ($d) {
                return $this->limitWord($d->project_name);
            })
            ->editColumn('project_logo', function ($d) {
                return $this->limitWord($d->project_logo);
            })
            ->editColumn('project_solution', function ($d) {
                return $this->limitWord($d->project_solution);
            })
            ->editColumn('project_challenge', function ($d) {
                return $this->limitWord($d->project_challenge);
            })
            ->editColumn('project_overview', function ($d) {
                return $this->limitWord($d->project_overview);
            })
            ->addColumn('action', '
            <a href="{{ route("project.edit",["id"=>$id]) }}" class="editItem" data-id="{{ $id }}"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a> <a href="javascript:void(0)" class="deleteItem" data-id="{{ $id }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
            ')->toJson();
    }

    public function teamListDatatable(Request $request)
    {
        $project = Team::orderBy("id", "desc")->get();
        return DataTables::of($project)
            ->editColumn('name', function ($d) {
                return $this->limitWord($d->name);
            })
            ->editColumn('position', function ($d) {
                return $this->limitWord($d->position);
            })
            ->editColumn('place_number', function ($d) {
                return $this->limitWord($d->place_number);
            })
            //->editColumn('cv', function ($d) {
            //     return $this->limitWord($d->cv);
            // })
            ->editColumn('photo', function ($d) {
                return '<image width=150 height=auto src="' . asset('uploads/team/photo/' . $d->id . '/' . $d->photo . '') . '"/>';
            })
            ->editColumn('background_color', function ($d) {
                return $this->limitWord($d->background_color);
            })
            ->addColumn('action', '
            <a href="{{ route("team.edit",["id"=>$id]) }}" class="editItem" data-id="{{ $id }}"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a> <a href="javascript:void(0)" class="deleteItem" data-id="{{ $id }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
            ')
            ->rawColumns(['photo', 'action'])
            ->toJson();
    }

    public function storeProject(Request $request)
    {

        $width = 200;
        $height = 200;

        $user = Auth::user();

        $messages = [
            'project_name.required' => 'Project Name required!',
            'project_challenge.required' => 'Project Challenge required!',
            'project_overview.required' => 'Project Overview required!',
            'project_solution.required' => 'Solution required!',
            'project_logo.required' => 'Logo required!',
            'project_objective_desc.required' => 'Objective required!',
            'project_objective.required' => 'Objective required!',
            'project_objective.*.required' => 'Objective required!',
            'project_result.required' => 'Result required!',
            'project_result.*.required' => 'Result required!',
            'project_result_desc.required' => 'Result required!',
            'project_twu_desc.required' => 'Technology We Used Name required!',
            'project_twu_name.required' => 'Technology We Used Name required!',
            'project_twu_name.*.required' => 'Technology We Used Name required!',
            'project_twu_logo.required' => 'Technology We Used Logo required!',
            'project_twu_logo.*.required' => 'Technology We Used Logo required!',
            'project_cf_desc.required' => 'Client Feedback required!',
            'project_cf_feedback.required' => 'Client Feedback required!',
            'project_cf_photo.required' => 'Client Photo required!',
            'project_cf_name.required' => 'Client Name required!',
            'project_cf_website.required' => 'Client Website required!',
            'project_cf_feedback.*.required' => 'Client Feedback required!',
            'project_cf_photo.*.required' => 'Client Photo required!',
            'project_cf_name.*.required' => 'Client Name required!',
            'project_cf_website.*.required' => 'Client Website required!',
            'other_cases.required' => 'Other Cases required!'
        ];

        $rule = [
            'project_name' => 'required',
            'project_challenge' => 'required',
            'project_overview' => 'required',
            'project_solution' => 'required',
            'project_logo' => 'required',
            'project_objective' => 'required',
            'project_objective_desc.required',
            'project_objective.*' => 'required',
            // 'project_result'=>'required',
            //'project_result_desc'=>'required',
            // 'project_result.*'=>'required',
            // 'project_twu_desc'=>'required',
            // 'project_twu_name'=>'required',
            // 'project_twu_name.*'=>'required',
            // 'project_twu_logo'=>'required',
            // 'project_twu_logo.*'=>'required',
            // 'project_cf_desc'=>'required',
            // 'project_cf_feedback'=>'required',
            // 'project_cf_photo'=>'required',
            // 'project_cf_name'=>'required',
            // 'project_cf_website'=>'required',
            // 'project_cf_feedback.*'=>'required',
            // 'project_cf_photo.*'=>'required',
            // 'project_cf_name.*'=>'required',
            // 'project_cf_website.*'=>'required',
            //'other_cases'=>'required'
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            $p = new Project;
            $p->project_name = $request->project_name;
            $p->url_slug = $request->url_slug;
            $p->meta_title = $request->meta_title;
            $p->meta_description = $request->meta_description;
            $p->meta_description_am = $request->meta_description_am;
            $p->meta_description_ru = $request->meta_description_ru;
            $p->project_logo = "";
            $p->project_logo_alt_description = $request->project_logo_alt_description;
            $p->project_overview = $request->project_overview;
            $p->project_overview_am = $request->project_overview_am;
            $p->project_overview_ru = $request->project_overview_ru;
            $p->project_challenge = $request->project_challenge;
            $p->project_challenge_am = $request->project_challenge_am;
            $p->project_challenge_ru = $request->project_challenge_ru;
            $p->project_solution = $request->project_solution;
            $p->project_solution_am = $request->project_solution_am;
            $p->project_solution_ru = $request->project_solution_ru;
            $p->project_objective_desc = $request->project_objective_desc;
            $p->project_result_desc = $request->project_result_desc;
            $p->project_result_desc_am = $request->project_result_desc_am;
            $p->project_result_desc_ru = $request->project_result_desc_ru;
            $p->project_twu_desc = $request->project_twu_desc;
            $p->project_cf_desc = $request->project_cf_desc;
            $p->other_case = $request->other_cases;
            $p->user_id = $user->id;
            $p->save();

            if ($request->file("project_logo")) {
                $ext = $request->file("project_logo")->getClientOriginalExtension();
                $file_size = $request->file("project_logo")->getSize();
                $file_name = date('YmdHis') . rand(1, 500) . rand(501, 1000) . '.' . $ext;
                $path = 'uploads/images/project/logo/' . $p->id;
                $dir_upload = public_path($path);
                if (!file_exists($dir_upload)) {
                    mkdir($dir_upload, 0777, true);
                }
                // upload file

                $image = $request->file("project_logo");
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize->save($dir_upload . '/resize_' . $file_name);

                $request->file("project_logo")->move($dir_upload, $file_name);

                $f = Project::find($p->id);
                $f->project_logo = $file_name;
                $f->save();
            }

            if ($request->project_objective) {
                if (count($request->project_objective) > 0) {
                    foreach ($request->project_objective as $key => $value) {
                        if (!empty($request->project_objective[$key])) {
                            $po = new ProjectObjective;
                            $po->objective = $request->project_objective[$key];
                            $po->objective_am = $request->project_objective_am[$key];
                            $po->objective_ru = $request->project_objective_ru[$key];
                            $po->project_id = $p->id;
                            $po->save();
                        }
                    }
                }
            }

            if ($request->project_result) {
                if (count($request->project_result) > 0) {
                    foreach ($request->project_result as $key => $value) {
                        if (!empty($request->project_result[$key])) {
                            $pr = new ProjectResult;
                            $pr->result = $request->project_result[$key];
                            $pr->result_am = $request->project_result_am[$key];
                            $pr->result_ru = $request->project_result_ru[$key];
                            $pr->project_id = $p->id;
                            $pr->save();
                        }
                    }
                }
            }

            if ($request->file("project_twu_logo")) {
                if (count($request->file("project_twu_logo")) > 0) {
                    foreach ($request->file("project_twu_logo") as $key => $value) {

                        $tt = new TechnologyTool;
                        $tt->name = $request->project_twu_name[$key];
                        $tt->logo = "";
                        $tt->project_id = $p->id;
                        $tt->save();

                        if ($request->file("project_twu_logo")[$key]) {
                            $ext = $request->file("project_twu_logo")[$key]->getClientOriginalExtension();
                            $file_size = $request->file("project_twu_logo")[$key]->getSize();
                            $file_name = date('YmdHis') . rand(1, 500) . rand(501, 1000) . '.' . $ext;
                            $path = 'uploads/images/project/twu/' . $p->id;
                            $dir_upload = public_path($path);
                            if (!file_exists($dir_upload)) {
                                mkdir($dir_upload, 0777, true);
                            }

                            $request->file("project_twu_logo")[$key]->move($dir_upload, $file_name);
                            $ft = TechnologyTool::find($tt->id);
                            $ft->logo = $file_name;
                            $ft->save();
                        }
                    }
                }
            }

            if ($request->file("project_cf_photo")) {
                if (count($request->file("project_cf_photo")) > 0) {
                    foreach ($request->file("project_cf_photo") as $key => $value) {


                        $pr = new ClientFeedback;
                        $pr->client_feedback = $request->project_cf_feedback[$key];
                        $pr->client_feedback_am = $request->project_cf_feedback_am[$key];
                        $pr->client_feedback_ru = $request->project_cf_feedback_ru[$key];
                        $pr->client_photo = "";
                        $pr->client_name =  $request->project_cf_name[$key];
                        $pr->client_name_am =  $request->project_cf_name_am[$key];
                        $pr->client_name_ru =  $request->project_cf_name_ru[$key];
                        $pr->client_position = "";
                        $pr->client_position_am = "";
                        $pr->client_position_ru = "";
                        $pr->client_website = $request->project_cf_website[$key];
                        $pr->project_id = $p->id;
                        $pr->save();

                        if (isset($request->file("project_cf_photo")[$key])) {
                            $ext = $request->file("project_cf_photo")[$key]->getClientOriginalExtension();
                            $file_size = $request->file("project_cf_photo")[$key]->getSize();
                            $file_name = date('YmdHis') . rand(1, 500) . rand(501, 1000) . '.' . $ext;
                            $path = 'uploads/images/project/cf/' . $p->id;
                            $dir_upload = public_path($path);
                            if (!file_exists($dir_upload)) {
                                mkdir($dir_upload, 0777, true);
                            }

                            $request->file("project_cf_photo")[$key]->move($dir_upload, $file_name);
                            $f = ClientFeedback::find($pr->id);
                            $f->client_photo = $file_name;
                            $f->save();
                        }
                    }
                }
            }

            //$tt = new TechnologyTool;
            //$tt->save();
            \Session::flash('success', 'Successfully added project!');
            return redirect(route('admin'))->with(['success' => 'Successfully added project!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

    public function storeTeam(Request $request)
    {

        $width = 200;
        $height = 200;

        $user = Auth::user();

        $messages = [
            'name.required' => 'Name required!',
            'position.required' => 'Position required!',
            'place_number.required' => 'Place Number required!',
            'background_color.required' => 'Background color required!',
        ];

        $rule = [
            'name' => 'required',
            'name_ru' => 'required',
            'name_am' => 'required',
            'position' => 'required',
            'position_ru' => 'required',
            'position_am' => 'required',
            'background_color' => 'required',
            'place_number' => 'required',
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            $p = new Team;
            $p->name = $request->name;
            $p->name_ru = $request->name_ru;
            $p->name_am = $request->name_am;
            $p->position = $request->position;
            $p->position_ru = $request->position_ru;
            $p->position_am = $request->position_am;
            $p->photo = "";
            $p->cv = "";
            $p->place_number = $request->place_number;
            $p->background_color = $request->background_color;
            $p->save();

            if ($request->file("photo")) {
                $ext = $request->file("photo")->getClientOriginalExtension();
                $file_size = $request->file("photo")->getSize();
                $file_name = date('YmdHis') . rand(1, 500) . rand(501, 1000) . '.' . $ext;
                $path = 'uploads/team/photo/' . $p->id;
                $dir_upload = public_path($path);
                if (!file_exists($dir_upload)) {
                    mkdir($dir_upload, 0777, true);
                }
                // upload file

                $image = $request->file("photo");
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize->save($dir_upload . '/resize_' . $file_name);

                $request->file("photo")->move($dir_upload, $file_name);

                $f = Team::find($p->id);
                $f->photo = $file_name;
                $f->save();
            }

            if ($request->file("cv")) {
                $ext = $request->file("cv")->getClientOriginalExtension();
                $file_size = $request->file("cv")->getSize();
                $file_name = date('YmdHis') . rand(1, 500) . rand(501, 1000) . '.' . $ext;
                $path = 'uploads/team/cv/' . $p->id;
                $dir_upload = public_path($path);
                if (!file_exists($dir_upload)) {
                    mkdir($dir_upload, 0777, true);
                }
                // upload file
                $request->file("cv")->move($dir_upload, $file_name);

                $f = Team::find($p->id);
                $f->cv = $file_name;
                $f->save();
            }

            \Session::flash('success', 'Successfully added team!');
            return redirect(route('team.list'))->with(['success' => 'Successfully added project!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

    public function updateTeam(Request $request)
    {

        $width = 200;
        $height = 200;

        $user = Auth::user();

        $messages = [
            'id.required' => 'ID required!',
            'name.required' => 'Name required!',
            'position.required' => 'Position required!',
            'place_number.required' => 'Place Number required!',
            'background_color.required' => 'Background color required!',
        ];

        $rule = [
            'name' => 'required',
            'name_ru' => 'required',
            'name_am' => 'required',
            'position' => 'required',
            'position_ru' => 'required',
            'position_am' => 'required',
            'background_color' => 'required',
            'place_number' => 'required',
            'id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            $p = Team::find($request->id);
            $p->name = $request->name;
            $p->name_ru = $request->name_ru;
            $p->name_am = $request->name_am;
            $p->position = $request->position;
            $p->position_ru = $request->position_ru;
            $p->position_am = $request->position_am;
            $p->place_number = $request->place_number;
            $p->background_color = $request->background_color;
            $p->save();

            if ($request->file("photo")) {
                $ext = $request->file("photo")->getClientOriginalExtension();
                $file_size = $request->file("photo")->getSize();
                $file_name = date('YmdHis') . rand(1, 500) . rand(501, 1000) . '.' . $ext;
                $path = 'uploads/team/photo/' . $p->id;
                $dir_upload = public_path($path);
                if (!file_exists($dir_upload)) {
                    mkdir($dir_upload, 0777, true);
                }
                // upload file

                $image = $request->file("photo");
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize->save($dir_upload . '/resize_' . $file_name);

                $request->file("photo")->move($dir_upload, $file_name);

                $f = Team::find($p->id);
                $f->photo = $file_name;
                $f->save();
            }

            if ($request->file("cv")) {
                $ext = $request->file("cv")->getClientOriginalExtension();
                $file_size = $request->file("cv")->getSize();
                $file_name = date('YmdHis') . rand(1, 500) . rand(501, 1000) . '.' . $ext;
                $path = 'uploads/team/cv/' . $p->id;
                $dir_upload = public_path($path);
                if (!file_exists($dir_upload)) {
                    mkdir($dir_upload, 0777, true);
                }
                // upload file
                $request->file("cv")->move($dir_upload, $file_name);

                $f = Team::find($p->id);
                $f->cv = $file_name;
                $f->save();
            }

            \Session::flash('success', 'Successfully update team!');
            return redirect(route('team.list'))->with(['success' => 'Successfully added project!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

    public function updateProject(Request $request)
    {

        $width = 200;
        $height = 200;

        $user = Auth::user();

        $messages = [
            'project_name.required' => 'Project Name required!',
            'project_challenge.required' => 'Project Challenge required!',
            'project_overview.required' => 'Project Overview required!',
            'project_solution.required' => 'Solution required!',
            'project_logo.required' => 'Logo required!',
            'project_objective_desc.required' => 'Objective required!',
            'project_objective.required' => 'Objective required!',
            'project_objective.*.required' => 'Objective required!',
            'project_result.required' => 'Result required!',
            'project_result.*.required' => 'Result required!',
            'project_result_desc.required' => 'Result required!',
            'project_twu_desc.required' => 'Technology We Used Name required!',
            'project_twu_name.required' => 'Technology We Used Name required!',
            'project_twu_name.*.required' => 'Technology We Used Name required!',
            'project_twu_logo.required' => 'Technology We Used Logo required!',
            'project_twu_logo.*.required' => 'Technology We Used Logo required!',
            'project_cf_desc.required' => 'Client Feedback required!',
            'project_cf_feedback.required' => 'Client Feedback required!',
            'project_cf_photo.required' => 'Client Photo required!',
            'project_cf_name.required' => 'Client Name required!',
            'project_cf_website.required' => 'Client Website required!',
            'project_cf_feedback.*.required' => 'Client Feedback required!',
            'project_cf_photo.*.required' => 'Client Photo required!',
            'project_cf_name.*.required' => 'Client Name required!',
            'project_cf_website.*.required' => 'Client Website required!',
            'other_cases.required' => 'Other Cases required!'
        ];

        $rule = [
            'project_name' => 'required',
            'project_challenge' => 'required',
            'project_overview' => 'required',
            'project_solution' => 'required',
            'project_objective' => 'required',
            'project_objective_desc.required',
            'project_objective.*' => 'required',
            // 'project_result'=>'required',
            //'project_result_desc'=>'required',
            // 'project_result.*'=>'required',
            //'project_twu_desc'=>'required',
            //'project_twu_name'=>'required',
            //'project_twu_name.*'=>'required',
            //'project_cf_desc'=>'required',
            // 'project_cf_feedback'=>'required',
            // 'project_cf_name'=>'required',
            // 'project_cf_website'=>'required',
            // 'project_cf_feedback.*'=>'required',
            // 'project_cf_name.*'=>'required',
            // 'project_cf_website.*'=>'required',
            //'other_cases'=>'required'
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            $p = Project::find($request->id);
            $p->project_name = $request->project_name;
            $p->url_slug = $request->url_slug;
            $p->meta_title = $request->meta_title;
            $p->meta_description = $request->meta_description;
            $p->meta_description_am = $request->meta_description_am;
            $p->meta_description_ru = $request->meta_description_ru;
            $p->project_logo_alt_description = $request->project_logo_alt_description;
            $p->project_overview = $request->project_overview;
            $p->project_overview_am = $request->project_overview_am;
            $p->project_overview_ru = $request->project_overview_ru;
            $p->project_challenge = $request->project_challenge;
            $p->project_challenge_am = $request->project_challenge_am;
            $p->project_challenge_ru = $request->project_challenge_ru;
            $p->project_solution = $request->project_solution;
            $p->project_solution_am = $request->project_solution_am;
            $p->project_solution_ru = $request->project_solution_ru;
            $p->project_objective_desc = $request->project_objective_desc;
            $p->project_result_desc = $request->project_result_desc;
            $p->project_result_desc_am = $request->project_result_desc_am;
            $p->project_result_desc_ru = $request->project_result_desc_ru;
            $p->project_twu_desc = $request->project_twu_desc;
            $p->project_cf_desc = $request->project_cf_desc;
            $p->other_case = $request->other_cases;
            $p->user_id = $user->id;
            $p->save();

            if ($request->file("project_logo")) {
                $ext = $request->file("project_logo")->getClientOriginalExtension();
                $file_size = $request->file("project_logo")->getSize();
                $file_name = date('YmdHis') . rand(1, 500) . rand(501, 1000) . '.' . $ext;
                $path = 'uploads/images/project/logo/' . $p->id;
                $dir_upload = public_path($path);
                if (!file_exists($dir_upload)) {
                    mkdir($dir_upload, 0777, true);
                }

                $image = $request->file("project_logo");
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize->save($dir_upload . '/resize_' . $file_name);

                // upload file
                $request->file("project_logo")->move($dir_upload, $file_name);
                $f = Project::find($p->id);
                $f->project_logo = $file_name;
                $f->save();
            }

            if ($request->project_objective) {
                if (count($request->project_objective) > 0) {
                    foreach ($request->project_objective as $key => $value) {
                        if (!empty($request->project_objective[$key])) {

                            if (isset($request->project_objective_id[$key])) {
                                $po = ProjectObjective::find($request->project_objective_id[$key]);
                            } else {
                                $po = new ProjectObjective;
                            }
                            $po->objective = $request->project_objective[$key];
                            $po->objective_am = $request->project_objective_am[$key];
                            $po->objective_ru = $request->project_objective_ru[$key];
                            $po->project_id = $p->id;
                            $po->save();
                        }
                    }
                }
            }

            if ($request->project_result) {
                if (count($request->project_result) > 0) {
                    foreach ($request->project_result as $key => $value) {
                        if (!empty($request->project_result[$key])) {
                            if (isset($request->project_result_id[$key])) {
                                $pr = ProjectResult::find($request->project_result_id[$key]);
                            } else {
                                $pr = new ProjectResult;
                            }
                            $pr->result = $request->project_result[$key];
                            $pr->result_am = $request->project_result_am[$key];
                            $pr->result_ru = $request->project_result_ru[$key];
                            $pr->project_id = $p->id;
                            $pr->save();
                        }
                    }
                }
            }

            if ($request->file("project_twu_logo")) {
                if (count($request->file("project_twu_logo")) > 0) {
                    foreach ($request->file("project_twu_logo") as $key => $value) {


                        if (isset($request->project_twu_id[$key])) {
                            $tt = TechnologyTool::find($request->project_twu_id[$key]);
                        } else {
                            $tt = new TechnologyTool;
                            $tt->logo = "";
                        }

                        $tt->name = $request->project_twu_name[$key];
                        $tt->project_id = $p->id;
                        $tt->save();

                        if (isset($request->file("project_twu_logo")[$key])) {
                            $ext = $request->file("project_twu_logo")[$key]->getClientOriginalExtension();
                            $file_size = $request->file("project_twu_logo")[$key]->getSize();
                            $file_name = date('YmdHis') . rand(1, 500) . rand(501, 1000) . '.' . $ext;
                            $path = 'uploads/images/project/twu/' . $p->id;
                            $dir_upload = public_path($path);
                            if (!file_exists($dir_upload)) {
                                mkdir($dir_upload, 0777, true);
                            }

                            $request->file("project_twu_logo")[$key]->move($dir_upload, $file_name);
                            $ft = TechnologyTool::find($tt->id);
                            $ft->logo = $file_name;
                            $ft->save();
                        }
                    }
                }
            }

            if ($request->file("project_cf_photo")) {
                if (count($request->file("project_cf_photo")) > 0) {
                    foreach ($request->file("project_cf_photo") as $key => $value) {


                        if (isset($request->project_cf_id[$key])) {
                            $pr = ClientFeedback::find($request->project_cf_id[$key]);
                        } else {
                            $pr = new ClientFeedback;
                            $pr->client_photo = "";
                        }

                        $pr->client_feedback = $request->project_cf_feedback[$key];
                        $pr->client_name =  $request->project_cf_name[$key];
                        $pr->client_position = "";
                        $pr->client_website = $request->project_cf_website[$key];
                        $pr->project_id = $p->id;
                        $pr->save();

                        if (isset($request->file("project_cf_photo")[$key])) {
                            $ext = $request->file("project_cf_photo")[$key]->getClientOriginalExtension();
                            $file_size = $request->file("project_cf_photo")[$key]->getSize();
                            $file_name = date('YmdHis') . rand(1, 500) . rand(501, 1000) . '.' . $ext;
                            $path = 'uploads/images/project/cf/' . $p->id;
                            $dir_upload = public_path($path);
                            if (!file_exists($dir_upload)) {
                                mkdir($dir_upload, 0777, true);
                            }

                            $request->file("project_cf_photo")[$key]->move($dir_upload, $file_name);
                            $f = ClientFeedback::find($pr->id);
                            $f->client_photo = $file_name;
                            $f->save();
                        }
                    }
                }
            }

            \Session::flash('success', 'Successfully updated project!');
            return redirect(route('project.list'))->with(['success' => 'Successfully updated project!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

    public function deleteProject(Request $request)
    {
        try {
            $id = $request->id;
            ProjectObjective::where('project_id', $id)->delete();
            ProjectResult::where('project_id', $id)->delete();
            TechnologyTool::where('project_id', $id)->delete();
            ClientFeedback::where('project_id', $id)->delete();
            Project::where('id', $id)->delete();
            \Session::flash('success', 'Successfully deleted project!');
            return response()->json('success', 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

    public function deleteTeam(Request $request)
    {
        try {
            $id = $request->id;
            $t = Team::where('id', $id)->first();
            $cv = "uploads/team/cv/" . $t->id . "/" . $t->cv;
            $photo = "uploads/team/photo/" . $t->id . "/" . $t->photo;
            if ($t->cv) {
                $deletephoto = File::delete($cv);
            }
            if ($t->photo) {
                $deletecv = File::delete($photo);
            }
            if (Team::where('id', $id)->delete()) {
                \Session::flash('success', 'Successfully deleted team!');
                return response()->json('success', 200);
            }
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'data' => []], 500);
        }
    }

    public function deleteEntity(Request $request)
    {

        $case = $request->case;
        $id = $request->id;

        try {

            switch ($case) {
                case 'objective':
                    ProjectObjective::where('id', $id)->first()->delete();
                    break;
                case 'result':
                    ProjectResult::where('id', $id)->first()->delete();
                    break;

                case 'tool':
                    TechnologyTool::where('project_id', $id)->orderBy("id", "desc")->first()->delete();
                    break;

                case 'cf':
                    ClientFeedback::where('project_id', $id)->orderBy("id", "desc")->first()->delete();
                    break;
                default:
                    return response()->json('success', 400);
                    break;
            }

            return response()->json('success', 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

    public function storeBlog(Request $request)
    {
        $width = 200;
        $height = 200;

        $user = Auth::user();

        $messages = [
            'title.required' => 'Title required!',
            'description.required' => 'Description required!',
            'image.required' => 'Image required!',
            'status.required' => 'Status required!',
            'category.required' => 'Category required!'
        ];

        $rule = [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
            'status' => 'required',
            'category' => 'required'
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            $p = new Blog;
            $p->title = $request->title;
            $p->title_am = $request->title_am;
            $p->title_ru = $request->title_ru;
            $p->url_slug = $request->url_slug;
            $p->meta_title = $request->meta_title;
            $p->meta_title_am = $request->meta_title_ru;
            $p->meta_title = $request->meta_title;
            $p->meta_description = $request->meta_description;
            $p->meta_description_am = $request->meta_description_am;
            $p->meta_description_ru = $request->meta_description_ru;
            $p->image_alt_description = $request->image_alt_description;
            $p->description = $request->description;
            $p->description_am = $request->description_am ?? null;
            $p->description_ru = $request->description_ru ?? null;
            $p->status = $request->status;
            $p->category_id = $request->category;
            $p->created_by = $request->created_by;
            $p->image = "";
            $p->view = 0;
            if (strtolower($request->status) == "publish") {
                $p->published_date = date("Y-m-d H:i:s");
            } else {
                $p->published_date = "";
            }
            $p->user_id = $user->id;
            $p->save();

            if ($request->file("image")) {
                $ext = $request->file("image")->getClientOriginalExtension();
                $file_size = $request->file("image")->getSize();
                $file_name = date('YmdHis') . rand(1, 500) . rand(501, 1000) . '.' . $ext;
                $path = 'uploads/images/blogs/' . $p->id;
                $dir_upload = public_path($path);
                if (!file_exists($dir_upload)) {
                    mkdir($dir_upload, 0777, true);
                }
                $image = $request->file("image");
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize->save($dir_upload . '/resize_' . $file_name);

                $request->file("image")->move($dir_upload, $file_name);

                $f = Blog::find($p->id);
                $f->image = $file_name;
                $f->save();
            }

            \Session::flash('success', 'Successfully added blog!');
            return redirect(route('admin.blog.index'))->with(['success' => 'Successfully added blog!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

    public function blogEdit($id)
    {
        $data["categories"] = Category::all();
        $data['blog'] = Blog::where("id", $id)->first();
        return view('admin/blog-edit', $data);
    }

    public function updateBlog(Request $request)
    {
        $width = 200;
        $height = 200;

        $user = Auth::user();

        $messages = [
            'title.required' => 'Title required!',
            'description.required' => 'Description required!',
            'status.required' => 'Status required!',
            'category.required' => 'Category required!'
        ];

        $rule = [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'category' => 'required'
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            $p = Blog::find($request->id);
            $p->title = $request->title;
            $p->title_am = $request->title_am;
            $p->title_ru = $request->title_ru;
            $p->url_slug = $request->url_slug;
            $p->meta_title = $request->meta_title;
            $p->meta_title_am = $request->meta_title_ru;
            $p->meta_title = $request->meta_title;
            $p->meta_description = $request->meta_description;
            $p->meta_description_am = $request->meta_description_am;
            $p->meta_description_ru = $request->meta_description_ru;
            $p->image_alt_description = $request->image_alt_description;
            $p->description = $request->description;
            $p->description_am = $request->description_am ?? null;
            $p->description_ru = $request->description_ru ?? null;
            $p->category_id = $request->category;
            $p->status = $request->status;
            $p->created_by = $request->created_by;
            if (strtolower($request->status) == "publish") {
                if (strlen($p->published_date) < 5 || strtolower($p->status) == "draft") {
                    $p->published_date = date("Y-m-d H:i:s");
                }
            } else {
                $p->published_date = "";
            }
            $p->user_id = $user->id;
            $p->save();

            if ($request->file("image")) {
                $ext = $request->file("image")->getClientOriginalExtension();
                $file_size = $request->file("image")->getSize();
                $file_name = date('YmdHis') . rand(1, 500) . rand(501, 1000) . '.' . $ext;
                $path = 'uploads/images/blogs/' . $p->id;
                $dir_upload = public_path($path);
                if (!file_exists($dir_upload)) {
                    mkdir($dir_upload, 0777, true);
                }
                $image = $request->file("image");
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize->save($dir_upload . '/resize_' . $file_name);

                $request->file("image")->move($dir_upload, $file_name);

                $f = Blog::find($p->id);
                $f->image = $file_name;
                $f->save();
            }

            \Session::flash('success', 'Successfully update blog!');
            return redirect(route('admin.blog.index'))->with(['success' => 'Successfully update blog!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

    public function deleteBlog(Request $request)
    {
        try {
            $id = $request->id;
            Blog::where('id', $id)->delete();
            \Session::flash('success', 'Successfully deleted blog!');
            return response()->json('success', 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }


    public function categories(Request $request)
    {
        return view('admin/categories');
    }

    public function categoryCreate(Request $request)
    {
        return view('admin/categorycreate');
    }

    public function categoryDatatable(Request $request)
    {
        $blog = Category::orderBy("id", "desc")->get();
        return DataTables::of($blog)
            ->editColumn('name', function ($d) {
                return $this->limitWord($d->name);
            })
            ->addColumn('action', '
            <a href="{{ route("category.edit",["id"=>$id]) }}" class="editItem" data-id="{{ $id }}"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a> <a href="javascript:void(0)" class="deleteItem" data-id="{{ $id }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
            ')
            ->rawColumns(['image', 'action', 'description'])
            ->make(true);
    }

    public function storeCategory(Request $request)
    {
        $messages = [
            'name.required' => 'Category name required!'
        ];

        $rule = [
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            $p = new Category;
            $p->name = $request->name;
            $p->save();

            \Session::flash('success', 'Successfully added category!');
            return redirect(route('admin.category.index'))->with(['success' => 'Successfully added category!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

    public function categoryEdit($id)
    {
        $data['category'] = Category::where("id", $id)->first();
        return view('admin/category-edit', $data);
    }

    public function updateCategory(Request $request)
    {
        $messages = [
            'name.required' => 'Category name required!'
        ];

        $rule = [
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            $p = Category::find($request->id);
            $p->name = $request->name;
            $p->save();

            \Session::flash('success', 'Successfully update category!');
            return redirect(route('admin.category.index'))->with(['success' => 'Successfully update category!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

    public function deleteCategory(Request $request)
    {
        try {
            $id = $request->id;
            Category::where('id', $id)->delete();
            \Session::flash('success', 'Successfully deleted category!');
            return response()->json('success', 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

    public function educationCategories(Request $request)
    {
        $categories = EducationCategory::latest()->get();
        return view('admin/education-categories', compact('categories'));
    }
    public function serviceCategories(Request $request)
    {
        $categories = ServiceCategory::latest()->get();
        return view('admin/service-categories', compact('categories'));
    }

    public function educationCategoryDatatable(Request $request)
    {
        $category = EducationCategory::orderBy("id", "desc")->get();
        return DataTables::of($category)
            ->editColumn('name', function ($d) {
                return $this->limitWord($d->name);
            })
            ->editColumn('name_am', function ($d) {
                return $this->limitWord($d->name_am);
            })
            ->editColumn('name_ru', function ($d) {
                return $this->limitWord($d->name_ru);
            })
            ->addColumn('action', '
            <a href="{{ route("admin.education-category.edit",["id"=>$id]) }}" class="editItem" data-id="{{ $id }}"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a> <a href="javascript:void(0)" class="deleteItem" data-id="{{ $id }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
            ')
            ->rawColumns(['image', 'action', 'description'])
            ->make(true);
    }
    public function serviceCategoryDatatable(Request $request)
        {
            $category = ServiceCategory::orderBy("id", "desc")->get();
            return DataTables::of($category)
                ->editColumn('name', function ($d) {
                    return $this->limitWord($d->name);
                })
                ->editColumn('name_am', function ($d) {
                    return $this->limitWord($d->name_am);
                })
                ->editColumn('name_ru', function ($d) {
                    return $this->limitWord($d->name_ru);
                })
                ->addColumn('action', '
                <a href="{{ route("admin.service-category.edit",["id"=>$id]) }}" class="editItem" data-id="{{ $id }}"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a> <a href="javascript:void(0)" class="deleteItem" data-id="{{ $id }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                ')
                ->rawColumns(['logo', 'action', 'description'])
                ->make(true);
        }
    public function educationCategoryCreate(Request $request)
    {
        return view('admin/education-category-create');
    }
    public function serviceCategoryCreate(Request $request)
    {
        return view('admin/service-category-create');
    }
    public function storeEducationCategory(Request $request)
    {
        $messages = [
            'name.required' => 'Education category name required!'
        ];
        $rule = [
            'name' => 'required'
        ];
        $validator = Validator::make($request->all(), $rule, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {

            $p = new EducationCategory;
            $p->name = $request->name;
            $p->name_am = $request->name_am;
            $p->name_ru = $request->name_ru;
            $p->save();

            \Session::flash('success', 'Successfully added education category!');
            return redirect(route('admin.education-categories.index'))->with(['success' => 'Successfully added education category!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }
    public function storeServiceCategory(Request $request)
    {
        $messages = [
            'name.required' => 'Service category name required!'
        ];
        $rule = [
            'name' => 'required'
        ];
        $validator = Validator::make($request->all(), $rule, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {

            $p = new ServiceCategory;
            $p->name = $request->name;
            $p->name_am = $request->name_am;
            $p->name_ru = $request->name_ru;
            $p->save();

            \Session::flash('success', 'Successfully added service category!');
            return redirect(route('admin.service-categories.index'))->with(['success' => 'Successfully added service category!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }
    public function educationCategoryEdit($id)
    {
        $data['category'] = EducationCategory::where("id", $id)->first();
        return view('admin/education-category-edit', $data);
    }
    public function serviceCategoryEdit($id)
    {
        $data['category'] = ServiceCategory::where("id", $id)->first();
        return view('admin/service-category-edit', $data);
    }
    public function updateEducationCategory(Request $request)
    {
        $messages = [
            'name.required' => 'Education Category name required!'
        ];
        $rule = [
            'name' => 'required'
        ];
        $validator = Validator::make($request->all(), $rule, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {

            $p = EducationCategory::find($request->id);
            $p->name = $request->name;
            $p->name_am = $request->name_am;
            $p->name_ru = $request->name_ru;
            $p->save();

            \Session::flash('success', 'Successfully update education category!');
            return redirect(route('admin.education-categories.index'))->with(['success' => 'Successfully update education category!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }
    public function updateServiceCategory(Request $request)
    {
        $messages = [
            'name.required' => 'Service Category name required!'
        ];
        $rule = [
            'name' => 'required'
        ];
        $validator = Validator::make($request->all(), $rule, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {

            $p = ServiceCategory::find($request->id);
            $p->name = $request->name;
            $p->name_am = $request->name_am;
            $p->name_ru = $request->name_ru;
            $p->save();

            \Session::flash('success', 'Successfully update service category!');
            return redirect(route('admin.service-categories.index'))->with(['success' => 'Successfully update service category!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }
    public function deleteEducationCategory(Request $request)
    {
        try {
            $id = $request->id;
            EducationCategory::where('id', $id)->delete();
            \Session::flash('success', 'Successfully deleted education category!');
            return response()->json('success', 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }
    public function deleteServiceCategory(Request $request)
    {
        try {
            $id = $request->id;
            ServiceCategory::where('id', $id)->delete();
            \Session::flash('success', 'Successfully deleted service category!');
            return response()->json('success', 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

    public function educations(Request $request)
    {
        return view('admin/educations');
    }

    public function educationCreate(Request $request)
    {
        $data["categories"] = EducationCategory::all();
        return view('admin/education-create', $data);
    }

    public function storeEducation(Request $request)
    {
        $width = 200;
        $height = 200;

        $user = Auth::user();

        $messages = [
            'title.required' => 'Title required!',
            'description.required' => 'Description required!',
            'image.required' => 'Image required!',
            'status.required' => 'Status required!',
            'category.required' => 'Category required!'
        ];

        $rule = [
            'title' => ['required', Rule::unique('educations')],
            'description' => 'required',
            'image' => 'required',
            'status' => 'required',
            'category' => 'required',
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $p = new Education;
            $p->title = $request->title;
            $p->title_am = $request->title_am;
            $p->title_ru = $request->title_ru;
            $p->description = json_decode($request->description);
            $p->description_am = json_decode($request->description_am ?? null);
            $p->description_ru = json_decode($request->description_ru ?? null);
            $p->status = $request->status;
            $p->education_category_id = $request->category;
            $p->created_by = $request->created_by;
            $p->is_featured = $request->is_featured;
            $p->order = $request->order;
            $p->image = "";
            $p->views = 0;
            if (strtolower($request->status) == "publish") {
                $p->published_date = date("Y-m-d H:i:s");
            } else {
                $p->published_date = "";
            }
            $p->user_id = $user->id;
            $p->save();

            if ($request->file("image")) {
                $ext = $request->file("image")->getClientOriginalExtension();
                $file_size = $request->file("image")->getSize();
                $file_name = date('YmdHis') . rand(1, 500) . rand(501, 1000) . '.' . $ext;
                $path = 'uploads/images/educations/' . $p->id;
                $dir_upload = public_path($path);
                if (!file_exists($dir_upload)) {
                    mkdir($dir_upload, 0777, true);
                }
                $image = $request->file("image");
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize->save($dir_upload . '/resize_' . $file_name);

                $request->file("image")->move($dir_upload, $file_name);

                $f = Education::find($p->id);
                $f->image = $file_name;
                $f->save();
            }

            \Session::flash('success', 'Successfully added education post!');
            return redirect(route('admin.educations.index'))->with(['success' => 'Successfully added education post!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

    public function educationEdit($id)
    {
        $data["categories"] = EducationCategory::all();
        $data['education'] = Education::find($id);
        return view('admin/education-edit', $data);
    }

    public function updateEducation(Request $request)
    {
        $width = 200;
        $height = 200;

        $user = Auth::user();
        $messages = [
            'title.required' => 'Title required!',
            'description.required' => 'Description required!',
            'status.required' => 'Status required!',
            'category.required' => 'Category required!'
        ];

        $rule = [
            'title' => ['required', Rule::unique('educations')->ignore($request->id)],
            'description' => 'required',
            'status' => 'required',
            'category' => 'required'
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $p = Education::find($request->id);
            $p->title = $request->title;
            $p->title_am = $request->title_am;
            $p->title_ru = $request->title_ru;
            $p->description = json_decode($request->description);
            $p->description_am = json_decode($request->description_am ?? null);
            $p->description_ru = json_decode($request->description_ru ?? null);
            $p->education_category_id = $request->category;
            $p->status = $request->status;
            $p->order = $request->order;
            $p->created_by = $request->created_by;
            $p->is_featured = $request->is_featured;
            if (strtolower($request->status) == "publish") {
                if (strlen($p->published_date) < 5 || strtolower($p->status) == "draft") {
                    $p->published_date = date("Y-m-d H:i:s");
                }
            } else {
                $p->published_date = "";
            }
            $p->user_id = $user->id;
            $p->save();

            if ($request->file("image")) {
                $ext = $request->file("image")->getClientOriginalExtension();
                $file_size = $request->file("image")->getSize();
                $file_name = date('YmdHis') . rand(1, 500) . rand(501, 1000) . '.' . $ext;
                $path = 'uploads/images/educations/' . $p->id;
                $dir_upload = public_path($path);
                if (!file_exists($dir_upload)) {
                    mkdir($dir_upload, 0777, true);
                }
                $image = $request->file("image");
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize->save($dir_upload . '/resize_' . $file_name);

                $request->file("image")->move($dir_upload, $file_name);

                $f = Education::find($p->id);
                $f->image = $file_name;
                $f->save();
            }

            \Session::flash('success', 'Successfully update education post!');
            return redirect(route('admin.educations.index'))->with(['success' => 'Successfully update education post!']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

    public function deleteEducation(Request $request)
    {
        try {
            $id = $request->id;
            Education::where('id', $id)->delete();
            \Session::flash('success', 'Successfully deleted education post!');
            return response()->json('success', 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Internal Error', 'data' => []], 500);
        }
    }

    public function educationDatatable(Request $request)
    {
        $education = Education::orderBy("id", "desc")->get();
        return DataTables::of($education)
            ->editColumn('title', function ($d) {
                return $this->limitWord($d->title);
            })
            ->editColumn('description', function ($d) {
                return $this->limitWord(EdJSParser::parse($d->description)->toHtml());
            })
            ->addColumn('category', function ($d) {
                $category_name = "";
                if ($category = EducationCategory::find($d->education_category_id)) {
                    $category_name = $category->name;
                }
                return $this->limitWord($category_name);
            })
            ->addColumn('order', function ($education) {
                return $education->order;
            })
            ->editColumn('image', function ($d) {
                return "<img width='100' height='100' src='" . url('uploads/images/educations/' . $d->id . '/resize_' . $d->image) . "'/>";
            })
            ->editColumn('published_date', function ($d) {
                return $this->limitWord($d->published_date);
            })
            ->addColumn('created_by', function ($d) {
                return $d->created_by;
            })
            ->addColumn('action', '
            <a href="{{ route("admin.education.edit", $id) }}" class="editItem" data-id="{{ $id }}"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a> <a href="javascript:void(0)" class="deleteItem" data-id="{{ $id }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
            ')
            ->rawColumns(['image', 'action', 'description'])
            ->make(true);
    }

    public function services(Request $request)
        {
            return view('admin/services');
        }

        public function serviceCreate(Request $request)
        {
            $data["categories"] = ServiceCategory::all();
            return view('admin/service-create', $data);
        }

        public function storeService(Request $request)
        {
            $width = 200;
            $height = 200;

            $user = Auth::user();

            $messages = [
                'title.required' => 'Title required!',
                'description.required' => 'Description required!',
                'logo.required' => 'Logo required!',
                'status.required' => 'Status required!',
                'category.required' => 'Category required!'
            ];

            $rule = [
                'title' => ['required', Rule::unique('services')],
                'description' => 'required',
                'logo' => 'required',
                'status' => 'required',
                'category' => 'required',
            ];

            $validator = Validator::make($request->all(), $rule, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            try {
                $p = new Service;
                $p->link = $request->link;
                $p->title = $request->title;
                $p->title_am = $request->title_am;
                $p->title_ru = $request->title_ru;
                $p->description = json_decode($request->description);
                $p->description_am = json_decode($request->description_am ?? null);
                $p->description_ru = json_decode($request->description_ru ?? null);
                $p->meta_description = json_decode($request->meta_description);
                $p->meta_description_am = json_decode($request->meta_description_am ?? null);
                $p->meta_description_ru = json_decode($request->meta_description_ru ?? null);
                $p->approach = json_decode($request->approach);
                $p->approach_am = json_decode($request->approach_am ?? null);
                $p->approach_ru = json_decode($request->approach_ru ?? null);
                $p->benefit = json_decode($request->benefit);
                $p->benefit_am = json_decode($request->benefit_am ?? null);
                $p->benefit_ru = json_decode($request->benefit_ru ?? null);
                $p->status = $request->status;
                $p->service_category_id = $request->category;
                $p->logo = "";
                $p->views = 0;
                if (strtolower($request->status) == "publish") {
                    $p->published_date = date("Y-m-d H:i:s");
                } else {
                    $p->published_date = "";
                }
                $p->user_id = $user->id;
                $p->save();

                if ($request->file("logo")) {
                    $ext = $request->file("logo")->getClientOriginalExtension();
                    $file_size = $request->file("logo")->getSize();
                    $file_name = date('YmdHis') . rand(1, 500) . rand(501, 1000) . '.' . $ext;
                    $path = 'uploads/images/services/' . $p->id;
                    $dir_upload = public_path($path);
                    if (!file_exists($dir_upload)) {
                        mkdir($dir_upload, 0777, true);
                    }
                    $logo = $request->file("logo");
                    $logo_resize = Logo::make($logo->getRealPath());
                    $logo_resize->resize($width, $height, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $logo_resize->save($dir_upload . '/resize_' . $file_name);

                    $request->file("logo")->move($dir_upload, $file_name);

                    $f = Service::find($p->id);
                    $f->logo = $file_name;
                    $f->save();
                }

                \Session::flash('success', 'Successfully added service post!');
                return redirect(route('admin.services.index'))->with(['success' => 'Successfully added service post!']);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Internal Error', 'data' => []], 500);
            }
        }

        public function serviceEdit($id)
        {
            $data["categories"] = ServiceCategory::all();
            $data['service'] = Service::find($id);
            return view('admin/service-edit', $data);
        }

        public function updateService(Request $request)
        {
            $width = 200;
            $height = 200;

            $user = Auth::user();
            $messages = [
                'title.required' => 'Title required!',
                'description.required' => 'Description required!',
                'status.required' => 'Status required!',
                'category.required' => 'Category required!'
            ];

            $rule = [
                'title' => ['required', Rule::unique('services')->ignore($request->id)],
                'description' => 'required',
                'status' => 'required',
                'category' => 'required'
            ];

            $validator = Validator::make($request->all(), $rule, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            try {
                $p = Service::find($request->id);
                $p->title = $request->title;
                $p->title_am = $request->title_am;
                $p->title_ru = $request->title_ru;
                $p->description = json_decode($request->description);
                $p->description_am = json_decode($request->description_am ?? null);
                $p->description_ru = json_decode($request->description_ru ?? null);
                $p->service_category_id = $request->category;
                $p->status = $request->status;
                $p->order = $request->order;
                $p->created_by = $request->created_by;
                $p->is_featured = $request->is_featured;
                if (strtolower($request->status) == "publish") {
                    if (strlen($p->published_date) < 5 || strtolower($p->status) == "draft") {
                        $p->published_date = date("Y-m-d H:i:s");
                    }
                } else {
                    $p->published_date = "";
                }
                $p->user_id = $user->id;
                $p->save();

                if ($request->file("logo")) {
                    $ext = $request->file("logo")->getClientOriginalExtension();
                    $file_size = $request->file("logo")->getSize();
                    $file_name = date('YmdHis') . rand(1, 500) . rand(501, 1000) . '.' . $ext;
                    $path = 'uploads/images/services/' . $p->id;
                    $dir_upload = public_path($path);
                    if (!file_exists($dir_upload)) {
                        mkdir($dir_upload, 0777, true);
                    }
                    $logo = $request->file("logo");
                    $logo_resize = Logo::make($logo->getRealPath());
                    $logo_resize->resize($width, $height, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $logo_resize->save($dir_upload . '/resize_' . $file_name);

                    $request->file("logo")->move($dir_upload, $file_name);

                    $f = Service::find($p->id);
                    $f->logo = $file_name;
                    $f->save();
                }

                \Session::flash('success', 'Successfully update service post!');
                return redirect(route('admin.services.index'))->with(['success' => 'Successfully update service post!']);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Internal Error', 'data' => []], 500);
            }
        }

        public function deleteService(Request $request)
        {
            try {
                $id = $request->id;
                Service::where('id', $id)->delete();
                \Session::flash('success', 'Successfully deleted service post!');
                return response()->json('success', 200);
            } catch (Exception $e) {
                return response()->json(['message' => 'Internal Error', 'data' => []], 500);
            }
        }

        public function serviceDatatable(Request $request)
        {
            $service = Service::orderBy("id", "desc")->get();
            return DataTables::of($service)
                ->editColumn('title', function ($d) {
                    return $this->limitWord($d->title);
                })
                ->editColumn('description', function ($d) {
                    return $this->limitWord(EdJSParser::parse($d->description)->toHtml());
                })
                ->addColumn('category', function ($d) {
                    $category_name = "";
                    if ($category = ServiceCategory::find($d->service_category_id)) {
                        $category_name = $category->name;
                    }
                    return $this->limitWord($category_name);
                })
                ->addColumn('order', function ($service) {
                    return $service->order;
                })
                ->editColumn('logo', function ($d) {
                    return "<img width='100' height='100' src='" . url('uploads/images/services/' . $d->id . '/resize_' . $d->logo) . "'/>";
                })
                ->editColumn('published_date', function ($d) {
                    return $this->limitWord($d->published_date);
                })
                ->addColumn('created_by', function ($d) {
                    return $d->created_by;
                })
                ->addColumn('action', '
                <a href="{{ route("admin.service.edit", $id) }}" class="editItem" data-id="{{ $id }}"><button class="btn btn-success"><i class="fa fa-edit"></i></button></a> <a href="javascript:void(0)" class="deleteItem" data-id="{{ $id }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                ')
                ->rawColumns(['logo', 'action', 'description'])
                ->make(true);
        }
}
