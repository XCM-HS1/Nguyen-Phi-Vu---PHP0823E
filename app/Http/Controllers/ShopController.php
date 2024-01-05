<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index (Request $request)
    {
        $categories_data = Category::orderBy('category', 'DESC')->get();

        $products = Product::orderBy('id', 'DESC')->where('availability', '=', 1)->paginate(6);
        $out_of_stock = Product::orderby('id', 'DESC')->where('availability', '=', 0)->paginate(6);
        $aProducts = Product::orderBy('price', 'DESC')->paginate(3);

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

        return view('client.shop-grid', compact('products', 'aProducts', 'categories_data', 'wishlistAuth', 'user_data', 'out_of_stock'));
    }

    public function search (Request $request)
    {
        $categories_data = Category::orderBy('category', 'DESC')->get();
        $aProducts = Product::orderBy('availability', 'DESC')->paginate(3);
        $out_of_stock = Product::orderby('id', 'DESC')->where('availability', '=', 0)->paginate(6);

        $products = new Product();
        if($request->search){
            $products = $products->where('product_name', 'like', "%$request->search%")
            ->orWhere('description', 'like', "%$request->search%");
        }
        $products = $products->orderBy('id', 'DESC')->paginate(10);

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

        return view('client.shop-grid', compact('products', 'categories_data', 'aProducts', 'wishlistAuth', 'user_data', 'out_of_stock'));
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

        $products = Product::where('slug', $slug)->get();
        foreach($products as $product){
            $review_data = Review::where('product_id', '=', $product->id)->get();
            $review_count = $review_data->count();

            $rating_avg = Review::where('product_id', '=', $product->id)->avg('rating');
            $rating_avg = number_format($rating_avg, 1);
        }

        $rProducts = Product::where('slug', '!=', $slug)->inRandomOrder('id')->get()->take(4);

        return view('client.product-detail', compact('products', 'rProducts', 'categories_data', 'wishlistAuth', 'user_data', 'review_count', 'rating_avg', 'review_data'));
    }

    public function category ($slug)
    {
        $category = Category::where('slug', $slug)->first();

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

        $categories = Category::where('slug', $slug)->get();

        $aProducts = Product::orderBy('availability', 'DESC')->paginate(3);

        return view('client.category', compact('category', 'categories_data', 'aProducts', 'categories', 'wishlistAuth', 'user_data'));
    }
}
