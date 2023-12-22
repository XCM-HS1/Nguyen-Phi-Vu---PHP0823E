<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class TestController extends Controller
{
    public function index ()
    {
        return view('test');
    }

    public function testIndex ()
    {
        return view('test_input');
    }

    public function test (Request $request)
    {
        if($request->test){
            // dd($request->test);
            return redirect()->route('admin.test')->with('success', 'Toastr successfully activated!');
        }
        else{
            return redirect()->route('admin.test')->with('error', 'Toastr is not activated!');
        }
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $data['title'] = $request->input('title');
        $data['content'] = $request->input('content');

        $options = array(
            'cluster' => 'ap1',
            'encrypted' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('Notify', 'send-message', $data);

        return redirect()->route('test');
    }
}
