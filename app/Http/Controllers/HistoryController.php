<?php


namespace App\Http\Controllers;


use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;

class HistoryController
{
    public function view(Request $request){

        $user = User::where('id', $request->user_id)->first();
        $orders = Orders::with('items')->where('user_id', $request->user_id)->orderBy('created_at', 'desc')->get();

        return view('history.view', [
            'orders' => $orders,
            'user' => $user
        ]);

        //dd($orders);
    }
}
