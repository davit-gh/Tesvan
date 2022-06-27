<?php

namespace App\Http\Controllers;

use App\Models\ClientFeedback;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Project;
use App\Models\ProjectObjective;
use App\Models\ProjectResult;
use App\Models\TechnologyTool;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['posts'] = [];
                $data['categories'] = ServiceCategory::query()->get();
                $data['most_viewed'] = Service::with('category')->orderByDesc('views')->limit(3)->get();

                foreach ($data['categories'] as $category) {
                    $data['posts'][$category->id] = $category->posts()->published()->orderBy('order')->limit(3)->get();
                }

                return view('service.service', $data);
            }

            public function list($service_category)
            {
                $service_category = str_replace('~', '-', str_replace('-', ' ', $service_category));
                $data['category'] = ServiceCategory::query()
                    ->with(['posts' => function ($query) {
                        $query->published()->orderBy('order');
                    }])
                    ->whereRaw('LOWER(name) like "%' . $service_category . '%" ')
                    ->first();

                if (!$data['category']) {
                    abort(404);
                }

                return view('service.list', $data);
            }

            public function detail($category, $slug)
            {
                $category = str_replace('~', '-', str_replace('-', ' ', $category));
                $slug = str_replace('~', '-', str_replace('-', ' ', $slug));

                $data['category'] = ServiceCategory::whereRaw('LOWER(name) like "%' . $category . '%" ')
                    ->firstOrFail();
                $data['post'] = Service::whereRaw('LOWER(title) like "%' . $slug . '%" ')
                    ->firstOrFail();
                $data['post']->increment('views');
                $data['blog_interest'] = Service::orderByRaw('RAND()')->limit(2)->get();
                $data['blog'] = [];

                $id = $data['service']->id;
               	$data['service_faq'] = ServiceFaq::where('service_id',$id)->get();

                return view('service.detail', $data);
            }

