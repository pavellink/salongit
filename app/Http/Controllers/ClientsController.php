<?php

namespace App\Http\Controllers;

use App\Filters\ItemFilter;
use App\Models\Orders;
use App\Models\User;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientsController
{
    public function index(Request $request){
        $items = User::with('bonus_lvl')->orderBy('count_orders', 'desc');
        $items = (new ItemFilter($items, $request))->apply()->paginate(15);

        //dd($items[0]);

        return view('clients.index',[
            'items' => $items,
        ]);
    }

    public function items(Request $request){
        $items = User::orderBy('id', 'desc');
        $items = (new ItemFilter($items, $request))->apply()->paginate(15);

        return view('clients.items',[
            'items' => $items
        ]);
    }

    public function create(){
        $new_id = User::insertGetId([
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('clients.edit', $new_id);
    }

    public function edit($id){
        $item = User::where('id', $id)->first();

        return view('clients.edit',[
            'item' => $item
        ]);
    }

    public function update($id, Request $request){
        $user = User::where('id', $id)->first();

        UserHistory::insert([
            'user_id' => $user->id,
            'role' => $user->role,
            'updated_by' => $user->updated_by,
            'name' => $user->name,
            'phone' => $user->phone,
            'email' => $user->email
        ]);

        User::where('id', $id)->update([
            'updated_by' => Auth::user()->id,
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        Orders::where('user_id', $id)->update([
            'user_name' => $request->name,
            'user_phone' => $request->phone,
        ]);

        return redirect()->route('clients');
    }

    public function getPhone(){

    }

    public function find(Request $request){
        $items = User::orderBy('count_orders', 'desc')->take(15);
        $items = (new ItemFilter($items, $request))->apply()->get();

        return view('components.popup_select', [
            'items' => $items
        ]);
    }
}
