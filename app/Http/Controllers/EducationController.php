<?php

namespace App\Http\Controllers;

use App\Models\ClientFeedback;
use App\Models\Education;
use App\Models\EducationCategory;
use App\Models\Project;
use App\Models\ProjectObjective;
use App\Models\ProjectResult;
use App\Models\TechnologyTool;
use Illuminate\Http\Request;

use Mail;

class EducationController extends Controller
{
    public function index()
    {
        $data['categories'] = EducationCategory::query()
            ->with(['posts' => function ($query) {
                $query->published()->latest('published_date')->limit(3);
            }])
            ->get();
        $data['featured'] = Education::with('category')->published()->where('is_featured', true)->latest('published_date')->first();
        $data['most_viewed'] = Education::with('category')->orderByDesc('views')->limit(3)->get();

        return view('education.education', $data);
    }

    public function list($education_category)
    {
        $education_category = strtr($education_category, ["-" => " "]);
        $data['category'] = EducationCategory::query()
            ->with(['posts' => function ($query) {
                $query->published();
            }])
            ->whereRaw('LOWER(name) like "%' . $education_category . '%" ')
            ->first();

        if (!$data['category']) {
            abort(404);
        }

        return view('education.list', $data);
    }

    public function detail($category, $slug)
    {
        $category = strtr($category, '-', ' ');
        $slug = strtr($slug, '-', ' ');

        $data['category'] = EducationCategory::whereRaw('LOWER(name) like "%' . $category . '%" ')
            ->firstOrFail();
        $data['post'] = Education::whereRaw('LOWER(title) like "%' . $slug . '%" ')
            ->firstOrFail();
        $data['blog_interest'] = Education::orderByRaw('RAND()')->limit(2)->get();
        $data['blog'] = [];
        $data['next_lessons'] = Education::with('category')
            ->where('education_category_id', $data['post']->education_category_id)
            ->where('created_at', '>', $data['post']->created_at)
            ->limit(4)
            ->get();

        return view('education.detail', $data);
    }
}
