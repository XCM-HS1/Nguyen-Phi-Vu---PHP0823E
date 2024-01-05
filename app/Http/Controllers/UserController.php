<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Review;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Routing\RedirectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\select;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function account(User $user)
    {
        return view('client.profile.client-profile', compact('user'));
    }

    public function security(User $user)
    {
        // dd($user);
        return view('client.profile.client-security', compact('user'));
    }

    public function purchaseHistory(User $user)
    {
        $order_data = Order::where('user_id', '=', $user->id)->get();
        // dd($order_data);

        return view('client.profile.client-purchase-history', compact('user', 'order_data'));
    }

    public function ratingIndex($id)
    {
        $user_data = User::where('id', '=', Auth::user()->id)->get();
        $order_data = Order::where('user_id', '=', Auth::user()->id)->get();
        foreach($order_data as $data){
            // dd($data);
        }
        return view('client.profile.client-rating', compact('user_data', 'data', 'id'));
    }

    public function rating (Request $request)
    {
        $product_id = $request->product_id;
        $order_data = DB::table('fixed_order_detail')->where('user_id', '=', Auth::user()->id)->where('product_id', '=', $product_id)->get();
        // dd($order_data);
        foreach($order_data as $data){
            // dd($data);

            $review['review'] = $request->review;
            $review['rating'] = $request->rating;
            if($request->hasFile('image')) {
                $path = $request->file('image')->store();
                $review['image'] = $path;
            }
            $review['status'] = 1;
            $review['created_at'] = now();
            $review['updated_at'] = now();
            // dd($review);

            $fixed['review_status'] = 1;

            DB::table('fixed_order_detail')->where('product_id', '=', $product_id)->update($fixed);
            $rating = DB::table('reviews')->where('order_id', '=', $data->order_id)->where('product_id', '=', $data->product_id)->update($review);
        }

        if($rating){
            return redirect()->route('client.home')->with('success', 'You have successfully rated an item!');
        }
        else{
            return redirect()->route('client.home')->with('error', 'Something went wrong, please try again later!');
        }
    }

    public function viewRating (string $id, string $product_id)
    {
        // $id is order id
        $user_data = User::where('id', '=', Auth::user()->id)->get();
        $view_data = DB::table('reviews')->where('order_id', '=', $id)->where('product_id', '=', $product_id)->get();
        $view_data_block = DB::table('reviews')->where('order_id', '=', $id)->where('product_id', '=', $product_id)->first();
        $fixed_data = DB::table('fixed_order_detail')->where('order_id', '=', $id)->where('product_id', '=', $product_id)->get();

        return view('client.profile.client-rating-view', compact('user_data', 'view_data', 'fixed_data', 'view_data_block'));
    }

    public function orderDetail ($id)
    {
        // $id = order id
        $user_data = User::where('id', '=', Auth::user()->id)->get();

        $orders = DB::table('orders')->where('id', '=', $id)->get();
        // dd($orders);
        foreach($orders as $data2){
            // dd($data2);
            $order_detail = DB::table('fixed_order_detail')->where('order_id', '=', $data2->id)->get();
            // dd($order_detail);
            foreach($order_detail as $data1){
                $review_data = Review::where('user_id', '=', Auth::user()->id)->get();
            }
        }
        return view('client.profile.client-order-detail', compact('orders', 'order_detail', 'user_data', 'review_data', 'data1', 'data2'));
    }

    public function changePassword(Request $request, User $user)
    {
        // dd($user);
        $currentPassword = Hash::check($request->current_password, Auth::user()->password);
        if(! $currentPassword)
        {
            // dd('Error 1 current password wrong');
            return back()->with('error', 'Your current password is not match!');
        }

        $confirmPassword = $request->password == $request->password_confirm;
        if(! $confirmPassword)
        {
            // dd('Error 2 password !== confirm password');
            return back()->with('error', 'Your have entered an unmachted new password!');
        }

        $user_data['password'] = Hash::make($request->password);
        if(User::where('id', '=', Auth::user()->id)->update($user_data)){
            Auth::logout();
            return redirect()->route('client.home')->with('success', 'Password changed successfully! Please login with your new password!');
        }
        else{
            return redirect()->route('client.home')->with('error', 'Something went wrong, please try again later!');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->only('email', 'name', 'phone_number');
        $user['password'] = Hash::make($request->password);

        $NameCheck = DB::table('users')->where('name', $request->name)->exists();
        if($NameCheck){
            return redirect()->route('user.register')->with('error', 'Username already existed!');
        }

        $EmailCheck = DB::table('users')->where('email', $request->email)->exists();
        if($EmailCheck){
            return redirect()->route('user.register')->with('error', 'Email already existed! Try login with socialite!');
        }

        $PhoneCheck = DB::table('users')->where('phone_number', $request->phone_number)->exists();
        if($PhoneCheck){
            return redirect()->route('user.register')->with('error', 'Phone number already existed!');
        }

        if($request->hasFile('user_avatar'))
        {
            $path = $request->file('user_avatar')->store('');
            $user['user_avatar'] = $path;
        }

        if(User::create($user)){
            Mail::to($request->email)->send(new RegisterMail($user));
            return redirect()->route('user.login')->with('success', 'Your account was created successful! Please login to continue!');
        }
        else{
            return redirect()->route('user.register')->with('error', 'Something went wrong please try again later!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user_data = $request->only('name', 'email', 'address', 'phone_number');

        $NameCheck = DB::table('users')->where('name', $request->name)->exists();
        if($NameCheck){
            return back()->with('error', 'Username already existed!');
        }

        if($request->password)
        {
            $user_data['password'] = Hash::make($request->password);
        }

        if($request->hasFile('user_avatar'))
        {
            $path = $request->file('user_avatar')->store('');
            $user_data['user_avatar'] = $path;

            $file = $user->user_avatar;

            if($user->user_avatar && Storage::exists($file))
            {
                Storage::delete($file);
            }
        }

        if(!$user->update($user_data))
        {
            return redirect()->route('user.account', $user->id)->with('error', 'Something went wrong! Please try again later!');
        }

        return redirect()->route('user.account', $user->id)->with('info', 'Your information has been updated successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function register()
    {
        return view('admin.user.register');
    }

    public function login()
    {
        return view('admin.user.login');
    }

    public function pLogin(Request $request)
    {
        // dd($request->all());
        $login = $request->only('email', 'password');
        if (Auth::attempt($login))
        {
            return redirect()->route('client.home')->with('success', 'You are logged in!');
        }
        else
        {
            return redirect()->back()->with('error', 'You have entered wrong email or password!');
        }
    }

    public function logout()
    {
        Auth::logout();
        Cart::instance('cart')->destroy();
        return redirect()->route('client.home');
    }
}
