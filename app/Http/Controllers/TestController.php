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

    public function ratingTest (Request $request)
    {
        $data = $request->rating;
        dd($data);
        return redirect()->route('admin.test2', compact('data'));
    }
}
