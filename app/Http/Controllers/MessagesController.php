<?php


namespace App\Http\Controllers;


use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController
{
    public function add(Request $request)
    {
        if(!$request->descr){
            return null;
        }

        $new_id = Messages::insertGetId([
            'order_id' => $request->order_id,
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'descr' => preg_replace('/^ +| +$|( ) +/m', '$1', $request->descr),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $message = Messages::where('id', $new_id)->first();

        return '<li class="me"><div class="message_wrap"><div class="message">'.nl2br($message->descr).'</div><div class="message_date">'.date('H:i').'</div></div></li>';

    }
}
