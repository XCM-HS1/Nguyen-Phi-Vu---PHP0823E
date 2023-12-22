<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index ()
    {
        $categories_data = Category::orderBy('category', 'DESC')->get();
        $cartItems = Cart::instance('cart')->content();

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
        // dd($cartItems);
        return view('client.cart', compact('cartItems', 'categories_data', 'wishlistAuth', 'user_data'));
    }

    public function addToCart (Request $request)
    {
        $product = Product::find($request->id);
        if(Cart::instance('cart')->add($product->id, $product->product_name, $request->quantity, $product->price, ['image' => $product->image])->associate('App\Models\Product')){
            return redirect()->back()->with('success', 'An item has been added to your cart!');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong, please try again later!');
        }
    }

    public function updateCart (Request $request)
    {
        if(Cart::instance('cart')->update($request->rowId, $request->quantity)){
            return redirect()->route('client.cart')->with('info', "An item's quantity has been updated!");
        }
        else{
            return redirect()->route('client.cart')->with('error', 'Something went wrong, please try again later!');
        }
    }

    public function removeItem (Request $request)
    {
        $rowId = $request->rowId;
        if(Cart::instance('cart')->remove($rowId)){
            return redirect()->route('client.cart')->with('success', 'An item has been removed from your cart!');
        }
        else{
            return redirect()->route('client.cart')->with('error', 'Something went wrong, please try again later!');
        }
    }

    public function clearCart ()
    {
        Cart::instance('cart')->destroy();

        return redirect()->route('client.cart')->with('success', 'You have removed all item from your cart!');
    }
}
