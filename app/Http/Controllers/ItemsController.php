<?php

namespace App\Http\Controllers;

use App\Filters\ItemFilter;
use App\Filters\QueryFilter;
use App\Models\Items;
use App\Models\Services;
use Illuminate\Http\Request;
use Str;

class ItemsController
{
    public function index(Request $request)
    {
        $items = Items::orderBy('position', 'asc')->orderby('id', 'desc')->paginate(50);

        return view('items.index',[
            'items' => $items,
            'url_filter' => route('items.filter')
        ]);
    }

    public function filter(Request $request)
    {
        $items = Items::orderBy('position', 'asc')->orderby('id', 'desc');
        $items = (new ItemFilter($items, $request->all()))->apply()->paginate(50);

        return view('items.items',[
            'items' => $items
        ]);
    }

    public function create()
    {
        $new_id = Items::insertGetId([
            'created_at' => date('Y-m-d H:i:s'),
            'position' => 999
        ]);

        return redirect()->route('items.edit', $new_id);
    }

    public function edit($id)
    {
        $item = Items::where('id', $id)->first();

        return view('items.edit',[
            'item' => $item,
        ]);
    }

    public function update($id, Request $request)
    {
        Items::where('id', $id)->update([
            'title' =>  $request->title,
            'slug' =>  Str::slug($request->title, '-'),
            'step' => (int) $request->step,
            'price' => $request->price,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('items');
    }

    public function delete(Request $request){

    }
}
