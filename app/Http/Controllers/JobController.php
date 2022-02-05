<?php

namespace App\Http\Controllers;

use App\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class JobController extends Controller
{
    public function index()
    {
        return view('job/job');
    }

    public function data()
    {
        $data = JobApplication::orderBy("id", "desc");
        return DataTables::of($data)
            ->editColumn('cv', function ($d) {
                return '<a href="' . asset($d->cv) . '" target="_blank">Download CV</a>';
            })
            ->editColumn('frameworks', function ($d) {
                return $d->frameworks ? implode(', ', $d->frameworks) : '';
            })
            ->addColumn('tools', function ($d) {
                return $d->tools ? implode(', ', $d->tools) : '';
            })
            ->rawColumns(['cv'])
            ->make(true);
    }

    public function JobApply(Request $request)
    {
        $experiences = [
            'No experience, but I have passed the QA courses',
            '1-2 years',
            '3-5 years',
            '5+ years',
        ];
        $data = [
            'name' => $request->get('name'),
            'surname' => $request->get('surname'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'city' => $request->get('city'),
            'experience' => $experiences[$request->get('experience')],
            'course' => $request->get('course'),
            'frameworks' => $request->get('frameworks'),
            'tools' => $request->get('tools'),
            'salary' => $request->get('salary'),
            'level' => $request->get('level'),
        ];
        $jobApplication = JobApplication::create($data);

        $cv = $request->file('cv');
        $mime = $cv->getMimeType();
        $cv->move(
            $path = "job_applications/{$jobApplication->id}",
            $name = $cv->getClientOriginalName()
        );

        $jobApplication->update([
            'cv' => $path . '/' . $name,
        ]);

        Mail::send('job_mail', $data, function ($message) use ($path, $name, $mime) {
            $message->from("davidg.tesvan@gmail.com");
            $message->to('jobs@tesvan.com', 'Admin')->subject("Tesvan");

            $message->attach(asset($path . '/' . $name), [
                'as' => $name,
                'mime' => $mime
            ]);
        });

        return response()->json([], 204);
    }
}
