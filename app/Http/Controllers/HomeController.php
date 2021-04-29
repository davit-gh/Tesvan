<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

use Mail;

class HomeController extends Controller
{

    public function index() {
        return view('index');
    }

    public function ContactUsForm(Request $request) {


        //  Send mail to admin
        \Mail::send('mail', array(
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'msg' => $request->get('message'),
        ), function($message) use ($request){
            $message->from('davidg.tesvan@gmail.com');
            $message->to('info@tesvan.com', 'Admin')->subject("Tesvan");

        });

        return redirect("/#contact-us")->with('success', 'We have received your message. Thank you!');
    }

    public function teams() {
        return view('teams');
    }

    public function teamsCv($file_name){
        $filename = str_replace(" ","_",$file_name);
        $path = public_path('documents/cv/'.$filename);

        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }

}
