<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function index ()
    {
        $categories_data = Category::orderBy('category', 'DESC')->get();
        $WishlistItems = Cart::instance('wishlist')->content();

        $products = Product::orderBy('id')->paginate(1);
        // $availability = DB::table('products')->join('wishlist', 'products.id', '=', 'wishlist.product_id')->select('availability')->get();
        // $availability = $availability[1]->availability;
        // dd($availability);

        $user_id = Auth::user()->id;
        // dd($user_id);
        $wishlistAuth = DB::table('wishlist')->where('user_id', '=', $user_id)->orderBy('updated_at', 'ASC')->get();
        // dd($wishlistAuth);

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

        return view('client.wishlist', compact('WishlistItems', 'categories_data', 'wishlistAuth', 'products', 'user_data'));
    }

    public function addToWishlist (Request $request)
    {
        $product = Product::find($request->id);
        // dd($product);
        $cart = Cart::instance('wishlist')->add($product->id, $product->product_name, 1, $product->price, ['availability' => $product->availability, 'image' => $product->image])->associate('App\Models\Product');

        $wishlistItems = Cart::instance('wishlist')->content();
        // dd($wishlistItems);
        foreach($wishlistItems as $item)
        {
            $wishlist_item['user_id'] = Auth::user()->id;
            $wishlist_item['user_name'] = Auth::user()->name;
            $wishlist_item['name'] = $item->name;
            $wishlist_item['product_id'] = $item->id;
            $wishlist_item['price'] = $item->price;
            $wishlist_item['availability'] = $item->options['availability'];
            $wishlist_item['rowId'] = $item->rowId;
            $wishlist_item['image'] = $item->options['image'];
            $wishlist_item['created_at'] = now();
            $wishlist_item['updated_at'] = now();

            $wishlist_exist = DB::table('wishlist')->where('product_id', $item->id)->exists();

        }

        if (!$wishlist_exist){
            DB::table('wishlist')->insert($wishlist_item);
        }
        else{
            return redirect()->back()->with('warning', 'That item is already in your wishlist! You can only add 1 item!');
        }

        if($cart){
            return redirect()->back()->with('info', 'An item has been added to your wishlist!');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong, please try again later!');
        }
    }

    public function remove (Request $request)
    {
        $rowId = $request->rowId;
        // dd($rowId);
        Cart::instance('wishlist')->remove($rowId);
        $delete = DB::table('wishlist')->where('rowId', '=', $rowId)->delete();

        if($delete){
            return redirect()->route('client.wishlist')->with('success', 'An item has been removed from your wishlist!');
        }
        else{
            return redirect()->route('client.wishlist')->with('error', 'Something went wrong, please try again later!');
        }
    }

    public function clearAll ()
    {
        Cart::instance('wishlist')->destroy();
        DB::table('wishlist')->delete();

        return redirect()->route('client.wishlist')->with('success', 'You have cleared out your wishlist!');
    }

    public function moveToCart (Request $request)
    {
        $rowId = $request->rowId;
        $item = Cart::instance('wishlist')->get($rowId);
        // dd($item);
        Cart::instance('cart')->add($item->model->id, $item->model->product_name, $item->qty, $item->model->price, ['image' => $item->model->image])->associate('App\Models\Product');
        Cart::instance('wishlist')->remove($rowId);
        DB::table('wishlist')->where('rowId', '=', $rowId)->delete();

        return redirect()->back()->with('success', 'An item has been added to your cart!');
    }
}
