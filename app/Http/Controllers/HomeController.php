<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()){
            $user_id = Auth::user()->id;
            $wishlistAuth = DB::table('wishlist')->where('user_id', '=', $user_id)->get();
            $user_data = User::where('id', '=', $user_id)->get();

        }
        else {
            $user_id = "";
            $wishlistAuth = "";
            $user_data = "";
        }

        $products = Product::orderBy('id', 'DESC')->get();

        return view('client.home', compact('wishlistAuth', 'products', 'user_data'));
    }
}
