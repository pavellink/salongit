<?php


namespace App\Http\Controllers;


use App\Models\OrderPre;
use App\Models\Services;
use App\Models\Statuses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreController
{
    public function index(){
        $items = OrderPre::with(['user', 'service.parent', 'status', 'manager'])->orderBy('id', 'desc')->get();

        return view('pre.index', [
            'items' => $items,
        ]);
    }

    public function edit($id){

        $item = OrderPre::where('id', $id)->first();
        $user = User::where('id', $item->user_id)->first();
        $service = Services::with('parent')->where('id', $item->service_id)->first();
        $statuses = Statuses::where('section', 'pre')->orderBy('position')->get();

        return view('pre.edit', [
            'item' => $item,
            'user' => $user,
            'statuses' => $statuses,
            'service' => $service
        ]);
    }

    public function update(Request $request){

        $item = OrderPre::where('id', $request->item_id)->first();

        OrderPre::where('id', $request->item_id)->update([
            'manager_id' => Auth::id(),
            'status_id' => $request->status_id,
            'descr' => $request->descr,
        ]);

        if(!$item->lead_time){
            OrderPre::where('id', $request->item_id)->update([
                'lead_time' => \Helper::timer($item->created_at),
                'first_act_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->route('pre');
    }
}
