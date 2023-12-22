<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $admin = new Admin();
        if ($request->search)
        {
            $admin = $admin->where('name', 'like', "%$request->search%")
                            ->orWhere('email', 'like', "%$request->search%");
        }

        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();
        $admin = $admin->withTrashed()->orderBy('id', 'DESC')->paginate(5);

        return view('admin.admin.index', compact('admin', 'admin_data'));
    }

    public function detail (Admin $admin)
    {
        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();

        return view('admin.admin-detail', compact('admin', 'admin_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();

        return view('admin.admin.create', compact('admin_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $admin = $request->only('name', 'email');
        $admin['password'] = Hash::make($request->password);

        if($request->hasFile('avatar'))
        {
            $path = $request->file('avatar')->store('');
            $admin['avatar'] = $path;
        }
        // dd($admin, $request->hasFile('image'));

        if(Admin::create($admin)){
            return redirect()->route('admin.admin.index')->with('success', 'New admin has been added successfully!');
        }
        else{
            return redirect()->route('admin.admin.index')->with('error', 'Something went wrong, please try again later!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        // dd($admin);
        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();

        return view('admin.admin.edit', compact('admin', 'admin_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $dataAdmin = $request->only('name', 'email');

        if($request->password)
        {
            $dataAdmin['password'] = Hash::make($request->password);
        }

        if($request->hasFile('avatar'))
        {
            $path = $request->file('avatar')->store('');
            $dataAdmin['avatar'] = $path;

            $file = $admin->avatar;

            if($admin->avatar && Storage::exists($file))
            {
                Storage::delete($file);
            }
        }

        if(!$admin->update($dataAdmin))
        {
            return redirect()->route('admin.admin.index')->with('error', 'Something went wrong! Please try again later!');
        }

        return redirect()->route('admin.admin.index')->with('info', 'An admin has been updated successfully!');
    }

    public function profileUpdate(Request $request, Admin $admin)
    {
        $dataAdmin = $request->only('name', 'email');

        if($request->password)
        {
            $dataAdmin['password'] = Hash::make($request->password);
        }

        if($request->hasFile('avatar'))
        {
            $path = $request->file('avatar')->store('');
            $dataAdmin['avatar'] = $path;

            $file = $admin->avatar;

            if($admin->avatar && Storage::exists($file))
            {
                Storage::delete($file);
            }
        }

        if(!$admin->update($dataAdmin))
        {
            return redirect()->route('admin.admin.index')->with('error', 'Something went wrong! Please try again later!');
        }

        return redirect()->route('admin.admin.index')->with('info', 'Updated successful');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin_avatar_trash = Admin::withTrashed()->where('id', '=', $admin->id)->select('avatar')->get();

        $file = $admin->avatar;

        if($admin->avatar && Storage::exists($file))
        {
            foreach($admin_avatar_trash as $item){
                $r = $item->avatar;
                Admin::withTrashed()->where('avatar', '=', $r)->update(['avatar' => null]);
            }
            Storage::delete($file);
        }

        if(! $admin->delete())
        {
            return redirect()->route('admin.admin.index')->with('error', 'Something went wrong! Please try again later!');
        }

        return redirect()->route('admin.admin.index')->with('warning', 'An admin has been temporary deleted! You can still recover with recover button!');
    }

    public function home ()
    {
        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();
        // dd($admin_data);
        // foreach(Auth::guard('admin')->user() as $item)
        // {
        //     dd($item);
        // }
        return view('admin.app', compact('admin_data'));
    }

    public function adminLogin()
    {
        return view('admin.admin-login');
    }

    public function pAdminLogin(Request $request)
    {
        $login = $request->only('email', 'password');
        Auth::guard('admin')->attempt($login);

        if(! Auth::guard('admin')->attempt($login))
        {
            return redirect()->back()->with('error', 'Wrong email or password!');
        }
        return redirect()->route('admin.home')->with('success', 'Welcome!');
    }

    public function adminLogout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }

    public function restore(string $id)
    {
        if(Admin::withTrashed()->where('id', '=', $id)->restore()){
            return redirect()->route('admin.admin.index')->with('info', "An Admin has been recovered successful!");
        }
        else{
            return redirect()->route('admin.admin.index')->with('error', 'Something went wrong, please try again later!');
        }
    }

    public function terminate(string $id)
    {
        if(Admin::withTrashed()->where('id', '=', $id)->forceDelete()){
            return redirect()->route('admin.admin.index')->with('success', 'An admin has been terminated, it cannot be recovered!');
        }
        else{
            return redirect()->route('admin.admin.index')->with('error', 'Something went wrong, please try again later');
        }
    }
}
