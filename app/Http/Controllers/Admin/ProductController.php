<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $product = new Product();
        if($request->search){
            $product = $product->where('product_name', 'like', "%$request->search%")
            ->orWhere('id', '=', "$request->search")
            ->orWhere('description', 'like', "%$request->search%");
        }

        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();

        $product = $product->orderBy('id', 'DESC')->paginate(4);

        return view('admin.product.index', compact('product', 'admin_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();

        $categories_data = Category::orderBy('category', 'ASC')->get();

        return view('admin.product.create', compact('categories_data', 'admin_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $product['product_name'] = $request->product_name;
        $product['slug'] = Str::slug($request->product_name);
        $product['price'] = $request->price;
        $product['availability'] = $request->availability;
        $product['weight'] = $request->weight;
        $product['description'] = $request->description;
        $product['category_id'] = $request->category;
        $product['created_at'] = now();
        $product['updated_at'] = now();

        if($request->hasFile('image'))
        {
            // dd($product, $request->hasFile('image'));
            $path = $request->file('image')->store();
            $product['image'] = $path;
        }

        if(DB::table('products')->insert($product)){
            return redirect()->route('admin.product.index')->with('success', 'A product has been added successfully!');
        }
        else{
            return redirect()->route('admin.product.index')->with('error', 'Something went wrong, please try again later!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = DB::table('products')->where('id', '=', $id)->first();
        $product_category = Product::orderBy('id')->get();

        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();

        $categories_data = Category::orderBy('category', 'DESC')->get();

        return view('admin.product.edit', compact('product', 'categories_data', 'product_category', 'admin_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product['product_name'] = $request->product_name;
        $product['slug'] = Str::slug($request->product_name);
        $product['price'] = $request->price;
        $product['availability'] = $request->availability;
        $product['weight'] = $request->weight;
        $product['category_id'] = $request->category;
        $product['created_at'] = now();
        $product['updated_at'] = now();

        if($request->description == ""){
            $product['description'] = $request->description_backup;
        }
        else {
            $product['description'] = $request->description;
        }

        if($request->availability == ""){
            $product['availability'] = 0;
        }

        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('');
            $product['image'] = $path;

            $data = Product::where('id', '=', $id)->select('image')->get();
            foreach($data as $item){
                $file = $item->image;
            }

            if($file && Storage::exists($file))
            {
                Storage::delete($file);
            }

        }

        if(! DB::table('products')->where('id', '=', $id)->update($product)){
            return redirect()->route('admin.product.index')->with('error', 'Something went wrong, please try again later!');
        }

        $wishlist['availability'] = $request->availability;
        if(! DB::table('wishlist')->where('product_id', '=', $id)->update($wishlist)){
            return redirect()->route('admin.product.index')->with('error', "Cannot store data to table:'wishlist'!");
        }

        return redirect()->route('admin.product.index')->with('info', 'A product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        $file = $product->image;

        if($product->image && Storage::exists($file))
        {
            Storage::delete($file);
        }

        if(! $product->delete())
        {
            return redirect()->route('admin.product.index')->with('error', 'Something went wrong! Please try again later!');
        }

        return redirect()->route('admin.product.index')->with('success', 'A product has been deleted successfully!');
    }
}
