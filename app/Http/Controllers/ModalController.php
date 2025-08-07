<?php


namespace App\Http\Controllers;


use App\Models\Calendar;
use App\Models\Log;
use App\Models\Messages;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Shifts;
use App\Models\Statuses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModalController
{
    public function phone(Request $request)
    {
        $item = User::where('id', $request->user_id)->first();

        $log = Log::insert([
            'act_id' => 1,
            'title' => 'Запрос телефона',
            'descr' => 'Имя: '.$item->name.', телефон: '.$item->phone,
            'referer' => $request->headers->get('referer'),
            'value' => $request->user_id,
            'created_by' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return view('modals.phone',[
            'item' => $item
        ]);
    }

    public function viewOrder(Request $request)
    {
        $order = Orders::with('service.parent')->where('id', $request->order_id)->first();
        $history = Orders::where('user_id', $order->user_id)->count();
        $status = Statuses::where('section', 'orders')->where('type', $order->status ?? 1)->first();
        $user = User::where('id', $order->user_id)->first();
        $items = OrderItems::where('order_id', $order->id)->get();
        //dd($items);
        $master = User::where('id', $order->master_id)->first();
        $messages = Messages::where('order_id', $order->id)->get();

        return view('modals.order',[
            'order' => $order,
            'items' => $items,
            'master' => $master,
            'messages' => $messages,
            'user' => $user,
            'status' => $status,
            'history' => $history
        ]);
    }

    public function dialogStatus(Request $request){
        $order = Orders::where('id', $request->order_id)->first();
        $statuses = Statuses::where('section', 'orders')->where('group', '!=', 2)->orderBy('position')->get()->groupBy('group');
        //dd($statuses);
        return view('modals.dialog_status',[
            'order' => $order,
            'statuses' => $statuses
        ]);
    }

    public function dialogPay(Request $request){
        $order = Orders::where('id', $request->order_id)->first();
        $user = User::where('id', $order->user_id)->first();
        $bonus = $user->count_bonuses ?? 0;
        $max = ($order->total_services ?? $order->total) * 0.3;
        $available = $bonus >= $max ? $max : $bonus;
        return view('modals.dialog_pay',[
            'order' => $order,
            'available' => $available,
            'user' => $user
        ]);
    }

    public function dialogHistory(Request $request){
        $order = Orders::where('id', $request->order_id)->first();
        $orders = Orders::with('items')->where('user_id', $order->user_id)->orderBy('created_at', 'desc')->get();
        return view('modals.dialog_history',[
            'orders' => $orders
        ]);
    }

    public function addShift(Request $request)
    {
        $users = User::where('role', 20)->get();
        $day = Calendar::where('id', $request->day_id)->first();

        return view('modals.add_shift',[
            'users' => $users,
            'day_id' => $request->day_id,
            'day' => $day
        ]);
    }

    public function viewShift(Request $request){
        $shift = Shifts::where('id', $request->shift_id)->first();
        $user = User::where('id', $shift->master_id)->first();
        $orders = Orders::where('shift_id', $shift->id)->where('master_id', $shift->master_id)->whereNull('in_progress')->get();

        return view('modals.view_shift',[
            'user' => $user,
            'shift' => $shift,
            'orders' => $orders
        ]);
    }

    static function myRand($count,$subcount){
        //return $subcount*round($count/$subcount);
        return $subcount*floor($count/$subcount); //в меньшую сторону
        //return $subcount*ceil($count/$subcount); //в большую сторону
    }
}
