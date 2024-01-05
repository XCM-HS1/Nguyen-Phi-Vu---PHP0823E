<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index (Request $request)
    {
        $categories_data = Category::orderBy('category', 'DESC')->get();
        $tags = Tag::all();

        //$blogs for search
        $blogs = new Blog();
        if($request->search){
            $blogs = $blogs->where('title', 'like', "%$request->search%")
            ->orWhere('content', 'like', "%$request->search%");
        }
        $blogs = $blogs->orderBy('id')->paginate(10);

        //$blog for latest news
        $blog = Blog::orderBy('created_at', 'DESC')->paginate(4);

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

        return view('client.blog', compact('blogs', 'blog', 'tags', 'categories_data', 'wishlistAuth', 'user_data'));
    }

    public function detail ($slug)
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

        $tags = Tag::all();

        $blogs = Blog::where('slug', $slug)->get();
        $lBlogs = Blog::orderBy('created_at', 'DESC')->paginate(4);
        $rBlogs = Blog::where('slug', '!=', $slug)->inRandomOrder('id')->get()->take(3);

        return view('client.blog-detail', compact('blogs', 'rBlogs', 'lBlogs', 'categories_data', 'wishlistAuth', 'tags', 'user_data'));
    }

    public function tag ($slug)
    {
        $categories_data = Category::orderBy('category', 'DESC')->get();

        $blogs_data = Blog::orderBy('created_at', 'DESC')->get();

        $tags_data = Tag::orderBy('id', 'ASC')->get();

        $tag = Tag::where('slug', $slug)->first();

        $tags = Tag::where('slug', $slug)->get();

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

        return view('client.tag', compact('tag', 'tags', 'tags_data', 'categories_data', 'wishlistAuth', 'blogs_data', 'user_data'));
    }
}
