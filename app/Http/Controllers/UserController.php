<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
        return view('client.profile.client-security', compact('user'));
    }

    public function purchaseHistory(User $user)
    {
        $order_data = Order::where('user_id', '=', $user->id)->get();
        // dd($order_detail);
        return view('client.profile.client-purchase-history', compact('user', 'order_data'));
    }

    public function orderDetail ($id)
    {
        $user_data = User::where('id', '=', Auth::user()->id)->get();

        $orders = DB::table('orders')->where('id', '=', $id)->get();
        // dd($orders);
        foreach($orders as $data){
            // dd($data);
            $order_detail = DB::table('fixed_order_detail')->where('order_id', '=', $data->id)->get();
            // dd($order_detail);
        }

        return view('client.profile.client-order-detail', compact('orders', 'order_detail', 'user_data'));
    }

    public function changePassword(Request $request, User $user)
    {
        $currentPassword = Hash::check($request->current_password, Auth::user()->password);
        if(! $currentPassword)
        {
            // dd('Error 1 current password wrong');
            return redirect()->route('user.security', $user->id)->with('error', 'Your current password is not match!');
        }

        $confirmPassword = $request->password == $request->password_confirm;
        if(! $confirmPassword)
        {
            // dd('Error 2 password !== confirm password');
            return redirect()->route('user.security', $user->id)->with('error', 'Your have entered an unmachted new password!');
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
