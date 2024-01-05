<?php

namespace App\Http\Controllers;

use App\Mail\OrderDetail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function vnpay (Request $request)
    {
        $data = $request->all();

        //* Store order information after submit
        //Store client information and order id
        $order['user_id'] = $request->id;
        $order['user_name'] = $request->name;
        $order['email'] = $request->email;
        $order['subtotal'] = Cart::instance('cart')->subtotal();
        $order['total'] = Cart::instance('cart')->total();
        $order['phone'] = $request->phone;
        $order['address'] = $request->address;
        $order['note'] = $request->note;
        $order['payment_method'] = 'VNPay';
        $order['status'] = 0;
        $order['created_at'] = now();
        $order['updated_at'] = now();

        $order_id = DB::table('orders')->insertGetId($order);

        $cartItems = Cart::instance('cart')->content();

        foreach($cartItems as $item) {
            $order_detail['order_id'] = $order_id;
            $order_detail['product_id'] = $item->id;
            $order_detail['products'] = $item->name;
            $order_detail['quantity'] = $item->qty;
            $order_detail['price'] = $item->price;
            $order_detail['created_at'] = now();
            $order_detail['updated_at'] = now();

            $fixed['user_id'] = Auth::user()->id;
            $fixed['user_name'] = Auth::user()->name;
            $fixed['order_id'] = $order_id;
            $fixed['product_id'] = $item->id;
            $fixed['products'] = $item->name;
            $fixed['image'] = $item->options->image;
            $fixed['quantity'] = $item->qty;
            $fixed['price'] = $item->price;
            $fixed['review_status'] = 0;
            $fixed['created_at'] = now();
            $fixed['updated_at'] = now();

            $review['user_id'] = Auth::user()->id;
            $review['user_name'] = Auth::user()->name;
            $review['status'] = 0;
            $review['order_id'] = $order_id;
            $review['product_id'] = $item->id;
            $review['product_name'] = $item->name;

            DB::table('order_detail')->insert($order_detail);
            DB::table('fixed_order_detail')->insert($fixed);
            DB::table('reviews')->insert($review);
        }

        $mail_order = [
            'user_name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'note' => $request->note,
            'order_id' => $order_id,
            'products' => $item->name,
            'quantity' => $item->qty,
            'price' => $item->price,
            'subtotal' => Cart::instance('cart')->subtotal(),
            'total' => Cart::instance('cart')->total(),
        ];
        
        Cart::instance('cart')->destroy();

        //Send order detail mail to customer
        Mail::to($request->email)->send(new OrderDetail($mail_order));


        //* VNPay application code
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
        $vnp_TmnCode = "SRLCAGQW";//Mã website tại VNPAY
        $vnp_HashSecret = "LVXYSRMISPXSJACLXEEZGEBAEEJWLLGY"; //Chuỗi bí mật

        $vnp_TxnRef = $order_id; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "VN Payment Demo";
        $vnp_OrderType = "Ogani E-Commerce";
        $vnp_Amount = $data['total'] *100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "USD",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
        }
}
