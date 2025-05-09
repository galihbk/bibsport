<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
    public function eventList() {}
    public function contact()
    {
        return view('home.contact');
    }
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        try {
            Mail::raw($request->message, function ($msg) use ($request) {
                $msg->to('net.galih7@gmail.com')
                    ->subject($request->subject)
                    ->from('noreply@bibsport.id', $request->name);
            });

            return response('OK', 200);
        } catch (\Exception $e) {
            return response('Gagal mengirim pesan: ' . $e->getMessage(), 500);
        }
    }
}
