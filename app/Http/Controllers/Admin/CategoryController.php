<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category = new Category();
        if($request->search){
            $category = $category->where('category', 'like', "%$request->search%");
        }

        $name = Auth::guard('admin')->user()->name;

        $admin_data = Admin::where('name', '=', $name)->get();

        $category = $category->orderBy('id')->paginate(3);

        return view('admin.category.index', compact('category', 'admin_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $name = Auth::guard('admin')->user()->name;

        $admin_data = Admin::where('name', '=', $name)->get();

        return view('admin.category.create', compact('admin_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = $request->only('category');
        $category['slug'] = Str::slug($request->category);

        if(Category::create($category)){
            return redirect()->route('admin.category.index')->with('success', 'A category has been added!');
        }
        else{
            return redirect()->route('admin.category.index')->with('error', 'Something went wrong, please try again later!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $name = Auth::guard('admin')->user()->name;

        $admin_data = Admin::where('name', '=', $name)->get();

        return view('admin.category.edit', compact('category', 'admin_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category['category'] = $request->category;
        $category['slug'] = Str::slug($request->category);

        if(DB::table('categories')->where('id', '=', $id)->update($category)){
            return redirect()->route('admin.category.index')->with('info', 'A category has been updated!');
        }
        else{
            return redirect()->route('admin.category.index')->with('error', 'Something went wrong, please try again later!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(DB::table('categories')->where('id', '=', $id)->delete()){
            return redirect()->route('admin.category.index')->with('success', 'A category has been deleted!');
        }
        else{
            return redirect()->route('admin.category.index')->with('error', 'Something went wrong, please try again!');
        }
    }
}
