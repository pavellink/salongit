<?php

namespace App\Http\Controllers;

use App\Models\Bonuses;
use App\Models\Calendar;
use App\Models\Items;
use App\Models\OrderItems;
use App\Models\OrderPre;
use App\Models\Orders;
use App\Models\Services;
use App\Models\Shifts;
use App\Models\Statuses;
use App\Models\User;
use App\Traits\OrderTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;

class OrdersController
{
    use OrderTrait;

    public function add(Request $request)
    {
        $date = null;

        if($request->day_id){
            $day = Calendar::where('id', $request->day_id)->first();
            $date = date("Y-m-d", strtotime($day->year.'-'.$day->month.'-'.$day->day));
        }

        //dd($date);
        //dd($request->all());

        $new_id = Orders::insertGetId([
            'master_id' => $request->master_id,
            'shift_id' => $request->shift_id,
            'time_start' => $request->time_start,
            'day_id' => $request->day_id,
            'date' => $date,
            'in_progress' => 1,
            'created_by' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('orders.create', $new_id)->with($request->all());
    }

    public function pre(Request $request){
        $pre = OrderPre::with('user')->where('id', $request->pre_id)->first();

        $date = Carbon::parse($pre->date_at);
        //dd($date);
        $day =  Calendar::where('day', $date->day)->where('month', $date->month)->where('year', $date->year)->first();
        //$day =

        $new_id = Orders::firstOrCreate([
            'pre_id' => $pre->id,
        ],
            [
            'day_id' => $day ? $day->id : null,
            'user_id' => $pre->user_id,
            'user_name' => $pre->user->name.' '.$pre->user->name2,
            'user_phone' => $pre->user->phone,
            'date' => $pre->date_at,
            'in_progress' => 1,
            'created_by' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);


        //dd($new_id);
        return redirect()->route('orders.create', $new_id)->with($request->all());
    }

    public function create($id, Request $request)
    {

        $carts = Cart::session($id)->getContent();

        //dd($carts);

        $mins = 0;
        foreach ($carts ?? [] as $cart){
            $mins = $mins + ($cart->mins * $cart->quantity);
        }
        //dd($carts);
        $collection = collect($carts);
        $carts = $collection->sortBy('id');
        foreach ($carts ?? [] as $cart){
            //dd($cart);
            if($cart->attributes->item_id){
                $cart->service = Services::with('setService.set')->where('id', $cart->attributes->item_id)->first();
                //dd($cart->service);
            }
        }

        $order = Orders::where('id', $id)->first();
        if($order->status >= 4){
            return redirect()->back()->with('success', 'Нельзя изменить завершенный заказ!');
        }

        $master = User::where('id', $order->master_id)->first();

        $shift = Shifts::with('day')->where('id', $order->shift_id)->first();

        $day_id = $order->day_id ? $order->day_id : ($shift ? $shift->day_id : 0);

        $users = Shifts::with('user')->where('day_id', $day_id)->get();
        $services = Services::with('subs')->whereNotNull('title')->whereNull('parent_id')->get();
        $products = Items::with('subs')->whereNotNull('title')->whereNull('parent_id')->get();

        //dd($products);

        $times = [];
        if($order->master_id){
            $times = Orders::where('shift_id', $shift->id)->orderBy('time_start')->whereNull('in_progress')->whereNotNull('status')->get();
            //dd($times);
        }

        //dd($carts);

        return view('orders.create', [
            'cart_id' => $id,
            'carts' => $carts,
            'master' => $master,
            'shift' => $shift,
            'users' => $users,
            'order' => $order,
            'items' => $services,
            'mins' => $mins,
            'times' => $times,
            'products' => $products
        ]);
    }

    public function preStore($id, Request $request)
    {
        //return $request->all();
        $day = $this->getDay($request->date);

        Orders::where('id', $id)->update([
            'day_id' => $day ? $day->id : null,
            'shift_id' => $request->shift_id,
            'master_id' => $request->master_id,
            'title' => $request->title,
            'date' => $request->date,
            'mins' => $request->mins,
            'time_start' => $request->time,
            'master_id' => $request->master_id,
        ]);

        Shifts::where('id', $request->shift_id)->update([
            'update_orders' => 1
        ]);
    }

    public function store($id, Request $request)
    {
        if(!$request->date || !$request->master_id || !$request->time || !$request->shift_id){
            return redirect()->back()->with('success', 'Заполните все поля!');
        }

        $order = Orders::where('id', $id)->first();
        if($request->find_or_new == 2){
            if(!$request->phone){
                return redirect()->back()->with('success', 'Не заполнен телефон!');
            }
            $phone = preg_replace('/^\+7/', '8', $request->phone);
            $phone = preg_replace("#[^0-9]#", "", $phone); // стерли хрень, оставили цифры

            if(empty($phone)){
                return redirect()->back()->with('success', 'Не заполнен телефон!');
            }
        }

        $carts = Cart::session($id)->getContent();
        if(count($carts) == 0){
            return redirect()->back()->with('success', 'Вы не можете создать заказ без услуг!');
        }

        $this->updateOrder($id, $request);
        $this->updateItems($id);
        $this->quantityCheck($id);

        $day = $this->getDay($request->date);

        return redirect()->route('days', ['day' => $day->day,'month' => $day->month,'year' => $day->year])->with('success', 'Заказ успешно создан!');
    }

    public function completed(Request $request)
    {
        Orders::where('id', $request->order_id)->update([
            'is_completed' => $request->checked == 'true' ? 1 : null
        ]);

        return $request->all();
    }

    public function selectUser(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();

        Orders::where('id', $request->order_id)->update([
            'user_name' => $user->name,
            'user_phone' => $user->phone,
            'user_id' => $user->id,
        ]);

        $order = Orders::where('id', $request->order_id)->first();

        return view('orders.components.user', [
            'order' => $order
        ]);
    }

    public function delete(Request $request){
        Orders::where('id', $request->order_id)->update([
            'deleted_by' => Auth::user()->id
        ]);
        Orders::where('id', $request->order_id)->delete();

        return redirect()->back()->with('success', 'Запись удалена!');
    }

    public function changeStatus(Request $request){
        $status = Statuses::where('id', $request->status_id)->first();
        //dd($status);
        Orders::where('id', $request->order_id)->update([
            'status' => $status->type
        ]);
        return true;
    }

    public function confirmNal(Request $request){
        //return $request->all();
        $order = Orders::where('id', $request->order_id)->whereNull('paid_type')->firstOrFail();

        $user = User::where('id', $order->user_id)->first();



        if($request->bonus && $user->count_bonuses < $request->bonus || $user->bonus_ban){
            return 'Ошибка списания бонусов';
        }

        Orders::where('id', $order->id)->update([
            'status' => 4,
            'paid_amount' => $request->sum,
            'paid_bonus' => $request->bonus,
            'paid_type' => $request->type
        ]);

        if($request->bonus){
            Bonuses::insert([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'title' => 'Списание бонусов',
                'count' => $request->bonus,
                'status_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        User::where('id', $user->id)->update([
            'count_bonuses' => $user->count_bonuses - $request->bonus,
            'update_bonus' => 1,
        ]);

        return true;
    }

}
