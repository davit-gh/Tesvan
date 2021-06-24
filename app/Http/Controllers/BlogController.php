<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\ClientFeedback;
use App\Models\Project;
use App\Models\ProjectObjective;
use App\Models\ProjectResult;
use App\Models\TechnologyTool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Mail;

class BlogController extends Controller
{

    public function index()
    {
        $data['blog'] = Blog::orderBy("id", "desc")->with('user')->limit(4)->get();
        $data['blog_popular'] = Blog::orderBy("view", "desc")->limit(3)->get();
        $data['blog_recent'] = Blog::orderBy("id", "desc")->get();
        $data['pathimage'] = url("uploads/images/blogs");
        return view('blog.blog', $data);
    }

    public function detail($name)
    {
        $name = str_ireplace("-", " ", $name);
        $data['bd'] = Blog::where(DB::raw('lower(title)'), 'like', '%' . $name . '%')->first();
        if (!$data['bd']) {
            abort(404);
        }
        $id = $data['bd']->id;
        $data['blog'] = Blog::where('id', "!=", $id)->get();
        $data['blog_interest'] = Blog::where('id', "!=", $id)->get();
        $data['pathimage'] = url("uploads/images/blogs");

        if (!$data['blog']) {
            abort(404);
        }

        viewBlog($id);

        return view('blog.detail', $data);
    }
}
