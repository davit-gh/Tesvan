<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Mail;

use Response;

class HomeController extends Controller
{

    public function index()
    {
        $data["teams"] = Team::orderBy("place_number", "asc")->limit(3)->get();
        return view('index', $data);
    }

    public function ContactUsForm(Request $request)
    {
        //  Send mail to admin
        \Mail::send('mail', array(
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'msg' => $request->get('message'),
        ), function ($message) use ($request) {
            $message->from(env('MAIL_FROM_ADDRESS'));
            $message->to('info@tesvan.com', 'Admin')->subject("Tesvan");
        });

        return redirect("/#contact-us")->with('success', 'We have received your message. Thank you!');
    }

    public function teams()
    {
        $data["teams"] = Team::orderBy("place_number", "asc")->get();
        return view('teams', $data);
    }

    public function teamsCv($file_name)
    {
        $filename = str_replace(" ", "_", $file_name);
        $path = public_path('documents/cv/' . $filename);

        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }

    public function privacy()
    {
        return view('privacy');
    }
}
