<?php

namespace App\Http\Controllers;

use App\Mail\OrderDetail;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
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
        return view('client.checkout', compact('cartItems', 'categories_data', 'wishlistAuth', 'user_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Store client information and order id
        $order['user_id'] = $request->id;
        $order['user_name'] = $request->name;
        $order['status'] = 0;
        $order['email'] = $request->email;
        $order['subtotal'] = Cart::instance('cart')->subtotal();
        $order['total'] = Cart::instance('cart')->total();
        $order['phone'] = $request->phone;
        $order['address'] = $request->address;
        $order['note'] = $request->note;
        $order['payment_method'] = 'COD';
        $order['created_at'] = now();
        $order['updated_at'] = now();

        $order_id = DB::table('orders')->insertGetId($order);
        // dd($order_data);

        // Store order_detail
        $cartItems = Cart::instance('cart')->content();
        // dd($cartItems);
        foreach($cartItems as $item) {
            // dd($item->options->image);
            $order_detail['order_id'] = $order_id;
            $order_detail['product_id'] = $item->id;
            $order_detail['products'] = $item->name;
            $order_detail['quantity'] = $item->qty;
            $order_detail['price'] = $item->price;
            $order_detail['created_at'] = now();
            $order_detail['updated_at'] = now();

            $fixed['user_id'] = Auth::user()->id;
            $fixed['user_name'] = Auth::user()->name;
            $fixed['order_id'] = $order_id;
            $fixed['product_id'] = $item->id;
            $fixed['products'] = $item->name;
            $fixed['image'] = $item->options->image;
            $fixed['quantity'] = $item->qty;
            $fixed['price'] = $item->price;
            $fixed['review_status'] = 0;
            $fixed['created_at'] = now();
            $fixed['updated_at'] = now();

            $review['user_id'] = Auth::user()->id;
            $review['user_name'] = Auth::user()->name;
            $review['status'] = 0;
            $review['order_id'] = $order_id;
            $review['product_id'] = $item->id;
            $review['product_name'] = $item->name;

            DB::table('order_detail')->insert($order_detail);
            DB::table('fixed_order_detail')->insert($fixed);
            DB::table('reviews')->insert($review);
        }

        $mail_order = [
            'user_name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'note' => $request->note,
            'order_id' => $order_id,
            'products' => $item->name,
            'quantity' => $item->qty,
            'price' => $item->price,
            'subtotal' => Cart::instance('cart')->subtotal(),
            'total' => Cart::instance('cart')->total(),
        ];

        //Send order detail mail to customer
        Mail::to($request->email)->send(new OrderDetail($mail_order));
        
        Cart::instance('cart')->destroy();

        return redirect()->route('client.checkout.success')->with('success', 'Your order has been placed successfully!Please check your email for details on this order!');
    }

    public function success()
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

        $categories_data = Category::orderBy('category', 'DESC')->get();

        return view('client.checkout-success', compact('categories_data', 'wishlistAuth', 'user_data'));
    }

}
