<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function index ()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(8);
        $lProducts = Product::orderBy('created_at', 'DESC')->paginate(3);
        $pProducts = Product::orderBy('price', 'DESC')->paginate(3);
        $aProducts = Product::orderBy('availability', 'DESC')->paginate(3);

        $blogs = Blog::orderBy('updated_at', 'DESC')->paginate(3);

        $categories_data = Category::orderBy('category', 'DESC')->get();

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

        return view('client.app', compact('products', 'lProducts', 'pProducts', 'aProducts', 'blogs', 'categories_data', 'wishlistAuth', 'user_data'));
    }

    public function contact()
    {
        $categories_data = Category::orderBy('category', 'DESC')->get();

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

        return view('client.contact', compact('categories_data', 'wishlistAuth', 'user_data'));
    }

}
