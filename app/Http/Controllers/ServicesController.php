<?php

namespace App\Http\Controllers;

use App\Filters\ItemFilter;
use App\Filters\QueryFilter;
use App\Models\Bonuses;
use App\Models\BonusLvl;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\SetItems;
use App\Models\Services;
use App\Models\Statuses;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;

class ServicesController
{
    public function index(Request $request)
    {

        /*Bonuses::whereNotNull('id')->delete();
        User::whereNotNull('id')->update([
            'count_bonuses' => null,
            'count_orders' => null,
            'bonus_lvl_id' => null,
            'update_bonus' => null,
            'update_lvl' => null,
        ]);
        Orders::whereNotNull('id')->update(['bonus_received' => null]);*/

        $items = Services::with('parent')->orderBy('position', 'asc')->orderby('id', 'desc')
            ->paginate(50);

        return view('services.index',[
            'items' => $items,
            'url_filter' => route('services.filter')
        ]);
    }



    public function groups(Request $request){
        $items = Services::with('subs')->whereNull('parent_id')->orderBy('position', 'asc')->orderby('id', 'desc')
            ->paginate(50);

        return view('services.groups',[
            'items' => $items,
            'url_filter' => route('services.filter')
        ]);
    }

    public function filter(Request $request)
    {
        $items = Services::orderBy('position', 'asc')->orderby('id', 'desc');
        $items = (new ItemFilter($items, $request->all()))->apply()->paginate(50);

        return view('services.items',[
            'items' => $items
        ]);
    }

    public function create()
    {
        $new_id = Services::insertGetId([
            'created_at' => date('Y-m-d H:i:s'),
            'position' => 999
        ]);

        return redirect()->route('services.edit', $new_id);
    }

    public function edit($id)
    {
        $item = Services::where('id', $id)->first();
        $services = Services::whereNull('parent_id')->orderBy('position')->get();
        //$products = SetItems::where('service_id', $id)->orderBy('position')->get();

        return view('services.edit',[
            'item' => $item,
            'services' => $services
        ]);
    }

    public function update($id, Request $request)
    {
        Services::where('id', $id)->update([
            'parent_id' =>  $request->parent_id,
            'title' =>  $request->title,
            'slug' =>  Str::slug($request->title, '-'),
            'mins' => $request->mins,
            'price' => $request->price,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('services');
    }

    public function delete(Request $request){

    }
}
