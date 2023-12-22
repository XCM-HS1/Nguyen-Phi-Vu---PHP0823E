<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Admin;
use App\Models\Message;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function index ()
    {
        return view('client.contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'email' => 'required|email',
            'body' => 'required',
            'footer' => 'required'
        ]);

        $message['status'] = 0;
        $message['name'] = $request->title;
        $message['email'] = $request->email;
        $message['phone'] = $request->phone;
        $message['message'] = $request->body;
        $message['created_at'] = now();
        $message['updated_at'] = now();
        DB::table('messages')->insert($message);

        try {
            $mailData = [
                'title' => $request->title,
                'body' => $request->body,
                'footer' => $request->footer,
            ];

            Mail::to($request->email)->send(new SendMail($mailData));

            return redirect()->route('client.contact')->with('success', 'Your message has been saved! We will contact you as soon as possible!');
        } catch (Exception $e) {
            return redirect()->route('client.contact')->with('error', $e->getMessage());
        }
    }

    public function message (Request $request)
    {
        $message = new Message();
        if ($request->search)
        {
            $message = $message->where('name', 'like', "%$request->search%")
                            ->orWhere('email', 'like', "%$request->search%")
                            ->orWhere('phone', '=', "%$request->search%");
        }

        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();
        $message = $message->orderBy('created_at', 'DESC')->paginate(5);

        return view('admin.message.index', compact('message', 'admin_data'));
    }

    public function messageDetail ($id)
    {
        $name = Auth::guard('admin')->user()->name;
        $admin_data = Admin::where('name', '=', $name)->get();

        $message = Message::where('id', '=', $id)->get();

        return view('admin.message.message-detail', compact('admin_data', 'message'));
    }

    public function status ($id)
    {
        $message_data = DB::table('messages')->where('id', '=', $id)->get();

        foreach($message_data as $item){
            if($item->status == 0){
                $message['status'] = 1;
                if(! DB::table('messages')->where('id', '=', $id)->update($message)){
                    return redirect()->route('admin.message.index')->with('error', "Something went wrong, please try again later!");
                }
            }

            if($item->status == 1){
                $message['status'] = 2;
                if(! DB::table('messages')->where('id', '=', $id)->update($message)){
                    return redirect()->route('admin.message.index')->with('error', "Something went wrong, please try again later!");
                }
            }
        }

        return redirect()->route('admin.message.index')->with('info', "Client's message is being handled!");
    }

}
