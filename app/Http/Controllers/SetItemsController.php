<?php


namespace App\Http\Controllers;


use App\Models\Items;
use App\Models\SetItems;
use Illuminate\Http\Request;

class SetItemsController
{
    public function add(Request $request){
        $id = SetItems::insertGetId([
            'set_id' => $request->set_id,
            'service_id' => $request->service_id
        ]);

        $setItem = SetItems::where('id', $id)->first();
        $products = Items::get();

        return view('sets.tr', [
            'setItem' => $setItem,
            'products' => $products
        ]);
    }

    public function update(){

    }

    public function delete(Request $request){
        SetItems::where('id', $request->set_id)->delete();
        return 1;
    }
}
