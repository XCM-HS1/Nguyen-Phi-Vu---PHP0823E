<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $order = new Order();
        if($request->search){
            $order = $order->where('user_name', 'like', "%$request->search%")
            ->orWhere('email', 'like', "%$request->search%")
            ->orWhere('id', '=', "$request->search")
            ->orWhere('phone', '=', "%$request->search%")
            ->orWhere('address', 'like', "%$request->search%")
            ->orWhere('note', 'like', "%$request->search%")
            ->orWhere('payment_method', 'like', "%$request->search%");
        }

        $name = Auth::guard('admin')->user()->name;

        $admin_data = Admin::where('name', '=', $name)->get();

        $order = $order->orderBy('id')->paginate(10);

        return view('admin.order.index', compact('order', 'admin_data'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('orders')->where('id', '=', $id)->delete();
        DB::table('order_detail')->where('id', '=', $id)->delete();

        return redirect()->route('admin.order.index')->with('success', 'Order has been terminated!');
    }

    public function viewOrder(Request $request, $id)
    {
        $orders = DB::table('orders')->where('id', '=', $id)->get();
        // dd($orders);
        // dd($order_detail);
        $order_detail = new OrderDetail();
        if($request->search){
            $order_detail = $order_detail->where('order_id', '=', "$request->search")
            ->orWhere('product_id', '=', "$request->search")
            ->orWhere('products', 'like', "%$request->search%");
        }

        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();

        $order_detail = OrderDetail::where('order_id', '=', $id)->get();

        return view('admin.order_detail.index', compact('orders', 'order_detail', 'admin_data'));
    }

    public function status (string $id)
    {
        $orders = DB::table('orders')->where('id', '=', $id)->get();

        foreach($orders as $item){
            if($item->status == 0){
                $order['status'] = 1;
                if(! DB::table('orders')->where('id', '=', $id)->update($order)){
                    return redirect()->route('admin.order.index')->with('error', "Order's status can be changed to 'Delivery'!");
                }
            }

            if($item->status == 1){
                $order['status'] = 2;
                if(! DB::table('orders')->where('id', '=', $id)->update($order)){
                    return redirect()->route('admin.order.index')->with('error', "Order's status can be changed to 'Completed'!");
                }
            }
        }

        return redirect()->route('admin.order.index')->with('info', "Order's status has been updated!");
    }
}
