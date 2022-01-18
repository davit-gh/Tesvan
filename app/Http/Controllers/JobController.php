<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index()
    {
        return view('job/job');
    }

    public function JobApply(Request $request)
    {
        $experiences = [
            'No experience, but I have passed the QA courses',
            '1-2 years',
            '3-5 years',
            '5+ years',
        ];

        Mail::send('job_mail', [
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
        ], function ($message) use ($request) {
            $message->from("davidg.tesvan@gmail.com");
            $message->to('jobs@tesvan.com', 'Admin')->subject("Tesvan");

            $message->attach($request->file('cv')->getRealPath(), [
                'as' => $request->file('cv')->getClientOriginalName(),
                'mime' => $request->file('cv')->getMimeType()
            ]);
        });

        return response()->json([], 204);
    }
}
