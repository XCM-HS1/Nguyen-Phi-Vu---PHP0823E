<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $blog = new Blog();
        if($request->search){
            $blog = $blog->where('title', 'like', "%$request->search%")
            ->orWhere('content', 'like', "%$request->search%");
        }

        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();

        $blog = $blog->orderBy('id')->paginate(10);

        return view('admin.blog.index', compact('blog', 'admin_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();

        $tags_data = Tag::orderBy('id', 'ASC')->get();
        // dd($tags_data);
        return view('admin.blog.create', compact('tags_data', 'admin_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $blog['title'] = $request->title;
        $blog['slug'] = Str::slug($request->title);
        $blog['content'] = $request->content;
        $blog['tag_id'] = $request->tag;
        $blog['created_at'] = now();
        $blog['updated_at'] = now();

        if($request->hasFile('image'))
        {
            // dd($product, $request->hasFile('image'));
            $path = $request->file('image')->store();
            $blog['image'] = $path;
        }

        if(! DB::table('blogs')->insert($blog)){
            return redirect()->route('admin.blog.index')->with('error', 'Something went wrong, please try again later!');
        }
        else{
            return redirect()->route('admin.blog.index')->with('success', 'A blog has been added successfully!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();

        $tags_data = Tag::orderBy('id', 'ASC')->get();
        return view('admin.blog.edit', compact('blog', 'tags_data', 'admin_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {

        $dataBlog = $request->only('title', 'content');
        $dataBlog['tag_id'] = $request->tag;
        $dataBlog['slug'] = Str::slug($request->title);


        // dd($dataBlog);
        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('');
            $dataBlog['image'] = $path;

            $file = $blog->image;
            dd($file);
            if($blog->image && Storage::exists($file))
            {
                Storage::delete($file);
            }
        }

        $blog->update($dataBlog);
        // dd($blog);
        if(!$blog->update($dataBlog))
        {
            return redirect()->route('admin.blog.index')->with('error', 'Something went wrong! Please try again later!');
        }

        return redirect()->route('admin.blog.index')->with('info', 'A blog has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $file = $blog->image;

        if($blog->image && Storage::exists($file))
        {
            Storage::delete($file);
        }

        if(! $blog->delete())
        {
            return redirect()->route('admin.blog.index')->with('error', 'Something went wrong! Please try again later!');
        }

        return redirect()->route('admin.blog.index')->with('success', 'A blog has been deleted successfully!');
    }

}
