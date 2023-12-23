<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $review = new Review();
        if ($request->search)
        {
            $review = $review->where('review', 'like', "%$request->search%")
                            ->orWhere('user_name', 'like', "%$request->search%")
                            ->orWhere('product_name', 'like', "%$request->search%");
        }

        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();
        $review = $review->orderBy('created_at', 'DESC')->paginate(5);

        return view('admin.review.index', compact('review', 'admin_data'));
    }

    public function proceed (Request $request)
    {
        $review_data['status'] = 2;
        if(Review::where('id', '=', $request->id)->update($review_data)){
            return redirect()->route('admin.review.index')->with('info', 'A review process has been updated!');
        }
        else{
            return redirect()->route('admin.review.index')->with('error', 'Something went wrong, please try again later!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();

        return view('admin.review.edit', compact('review', 'admin_data'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $file = $review->image;

        if($review->image && Storage::exists($file))
        {
            Storage::delete($file);
        }

        if(! $review->delete())
        {
            return redirect()->route('admin.review.index')->with('error', 'Something went wrong! Please try again later!');
        }

        return redirect()->route('admin.review.index')->with('success', 'A review has been deleted successfully!');
    }
}
