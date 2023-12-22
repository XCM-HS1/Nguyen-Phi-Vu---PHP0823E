<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\Admin;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Auth\User as AuthUser;
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
    public function index(Request $request)
    {
        $user = new User();
        if($request->search){
            $user = $user->where('name', 'like', "%$request->search%")
            ->orWhere('email', 'like', "%$request->search%");
        }

        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();

        $user = $user->withTrashed()->orderBy('id')->paginate(5);

        return view('admin.user.index', compact('user', 'admin_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();

        return view('admin.user.create', compact('admin_data'));
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
            return redirect()->route('admin.user.index')->with('success', 'An user account has been added!');
        }
        else{
            return redirect()->route('admin.user.index')->with('error', 'Something went wrong, please try again later!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();

        return view('admin.user.edit', compact('user', 'admin_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $dataUser = $request->only('name', 'email', 'phone_number');

        if($request->password)
        {
            $dataUser['password'] = Hash::make($request->password);
        }

        if($request->hasFile('user_avatar'))
        {

            $path = $request->file('user_avatar')->store();
            $dataUser['user_avatar'] = $path;

            $file = $user->user_avatar;

            if($user->user_avatar && Storage::exists($file))
            {
                Storage::delete($file);
            }
        }

        if(!$user->update($dataUser))
        {
            return redirect()->route('admin.user.index')->with('error', 'Something went wrong! Please try again later!');
        }

        return redirect()->route('admin.user.index')->with('info', 'An user account has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user_avatar_trash = User::withTrashed()->where('id', '=', $user->id)->select('user_avatar')->get();

        $file = $user->user_avatar;

        if($user->user_avatar && Storage::exists($file))
        {
            foreach($user_avatar_trash as $item){
                $r = $item->user_avatar;
                User::withTrashed()->where('user_avatar', '=', $r)->update(['user_avatar' => null]);
            }
            Storage::delete($file);
        }

        if(! $user->delete())
        {
            return redirect()->route('admin.user.index')->with('error', 'Something went wrong! Please try again later!');
        }

        if(! DB::table('wishlist')->where('user_id' , '=', $user->id)->delete()){
            return redirect()->route('admin.user.index')->with('error', "Cannot delete user wishlist from table: 'wishlist'!");
        }

        return redirect()->route('admin.user.index')->with('warning', 'An user account has been temporary disable! You can restore the account with the restore button below!');
    }

    public function restore(string $id)
    {
        if(User::withTrashed()->where('id', '=', $id)->restore()){
            return redirect()->route('admin.user.index')->with('success', 'An user account has been restored!');
        }
        else{
            return redirect()->route('admin.user.index')->with('error', 'Something went wrong, please try again later!');
        }
    }

    public function terminate(string $id)
    {
        if(User::withTrashed()->where('id', '=', $id)->forceDelete()){
            return redirect()->route('admin.user.index')->with('success', 'An user account has been terminated!');
        }
        else{
            return redirect()->route('admin.user.index')->with('error', 'Something went wrong, please try again later!');
        }
    }
}
