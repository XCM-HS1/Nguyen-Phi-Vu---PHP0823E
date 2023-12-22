<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $tag = new Tag();

        if($request->search){
            $tag = $tag->where('name', 'like', "%$request->search%");
        }

        $name = Auth::guard('admin')->user()->name;

        $admin_data = Admin::where('name', '=', $name)->get();

        $tag = $tag->orderBy('id', 'DESC')->paginate(10);

        // return view('admin.tag.index', compact('tag'));
        return view('admin.tag.index', compact('tag', 'admin_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $name = Auth::guard('admin')->user()->name;

        $admin_data = Admin::where('name', '=', $name)->get();

        return view('admin.tag.create', compact('admin_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tag['name'] = $request->name;
        $tag['created_at'] = now();
        $tag['updated_at'] = now();
        $tag['slug'] = Str::slug($request->name);

        if(DB::table('tags')->insert($tag)){
            return redirect()->route('admin.tag.index')->with('success', 'A tag has been added!');
        }
        else{
            return redirect()->route('admin.tag.index')->with('error', 'Something went wrong, please try again later!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tag = DB::table('tags')->where('id', '=', $id)->first();
        // dd($category);

        $name = Auth::guard('admin')->user()->name;

        $admin_data = Admin::where('name', '=', $name)->get();

        return view('admin.tag.edit', compact('tag', 'admin_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tag['name'] = $request->name;
        $tag['created_at'] = now();
        $tag['updated_at'] = now();
        $tag['slug'] = Str::slug($request->name);

        if(! DB::table('tags')->where('id', '=', $id)->update($tag)){
            return redirect()->route('admin.tag.index')->with('info', 'A tag has been updated!');
        }
        else{
            return redirect()->route('admin.tag.index')->with('error', 'Something went wrong, please try again later!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if(DB::table('tags')->where('id', '=', $id)->delete()){
            return redirect()->route('admin.tag.index')->with('success', 'A tag has been destroyed!');
        }
        else{
            return redirect()->route('admin.tag.index')->with('error', 'Something went wrong, please try again later!');
        }
    }

    public function index2 (Tag $tag)
    {
        $blogs = $tag->blogs;

        return view('client.blog', compact('blogs'));
    }
}
