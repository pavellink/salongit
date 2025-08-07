<?php

namespace App\Traits;

use App\Models\Calendar;
use App\Models\Items;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Services;
use App\Models\Shifts;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;

trait OrderTrait
{
    public function updateOrder($id, Request $request)
    {
        $order = Orders::where('id', $id)->first();

        $i = 0;
        $title = 'Заказ №'.$id;

        $carts = Cart::session($id)->getContent();
        //dd($carts);

        $carts = collect($carts)->sortByDesc('price');
        //dd($carts);

        $priceService = 0;
        $priceItems = 0;
        foreach ($carts ?? [] as $cart){
            $priceService = $priceService + ($cart->price * $cart->quantity);
            $i++;
            $priceItems = $priceItems + $cart->set_total;
        }

        foreach ($carts ?? [] as $cart){
            //dd($cart->attributes->section);

            //dd($cart);
            echo $cart->attributes->item_id.'<br>';
            $product = Services::with('parent')->where('id', $cart->attributes->item_id)->first();
            $title = ($product->parent ? $product->parent->title.': ' : null).$cart->name;

            break;
        }


        //dd($title);
        if($i > 1){
            $title = $title.' + '.($i - 1).' усл.';
        }

        //dd($title);
        //dd($title);
        $day = $this->getDay($request->date);
        //dd($day);

        $update = [];

        if(!$order->user_id && $request->find_or_new == 2){

            $phone = preg_replace('/^\+7/', '8', $request->phone);
            $phone = preg_replace("#[^0-9]#", "", $phone); // стерли хрень, оставили цифры

            $user = User::firstOrCreate([
                'phone' => $phone
            ],[
                'name' => $request->name,
                'created_by' => Auth::id()
            ]);

            $update = array_merge($update, ['user_id' => $user->id]);
            $update = array_merge($update, ['user_name' => $user->name]);
            $update = array_merge($update, ['user_phone' => $user->phone]);
        }

        if(!$order->status){
            $update = array_merge($update, ['status' => 1]);
        }


        $update = array_merge($update, ['day_id' => $day ? $day->id : null]);
        $update = array_merge($update, ['shift_id' => $request->shift_id]);
        $update = array_merge($update, ['master_id' => $request->master_id]);
        $update = array_merge($update, ['title' => $title]);
        $update = array_merge($update, ['descr' => $request->descr]);
        $update = array_merge($update, ['total' => $priceItems + $priceService]);
        $update = array_merge($update, ['total_items' => $priceItems]);
        $update = array_merge($update, ['total_services' => $priceService]);
        $update = array_merge($update, ['date' => $request->date]);
        $update = array_merge($update, ['time_start' => $request->time]);
        $update = array_merge($update, ['time_finish' => Carbon::parse($request->date.' '.$request->time)->addMinutes($request->mins)->format('H:i:s')]);
        $update = array_merge($update, ['mins' => $request->mins]);
        $update = array_merge($update, ['in_progress' => null]);

        if($request->unit_id){
            $update = array_merge($update, ['unit_id' => $request->unit_id]);
        }
        if($request->permalink){
            $update = array_merge($update, ['permalink' => $request->permalink]);
        }

        Orders::where('id', $id)->update($update);

        Shifts::where('id', $request->shift_id)->update([
           'update_orders' => 1
        ]);

    }

    public function updateItems($id)
    {
        $carts = Cart::session($id)->getContent();

        foreach ($carts as $cart){
            //dd($cart);
            //echo (json_encode ($cart->items, JSON_UNESCAPED_UNICODE));
            OrderItems::updateOrCreate(
                ['order_id' => $id, 'item_id' => $cart->attributes->item_id],
                [
                    'title' => $cart->name,
                    'products' => $cart->items ? json_encode($cart->items, JSON_UNESCAPED_UNICODE) : null,
                    'price' => $cart->price,
                    'count' => $cart->quantity,
                    'mins' => $cart->mins,
                    'total_services' => Cart::session($id)->get($cart->id)->getPriceSum(),
                    'total' => Cart::session($id)->get($cart->id)->getPriceSum() + $cart->set_total ?? 0,
                    'created_by' => Auth::user() ? Auth::user()->id : null,
                ]
            );
        }
        return true;
    }

    public function quantityCheck($id)
    {
        $carts = Cart::session($id)->getContent();

        $order_items = OrderItems::where('order_id', $id)->get();
        if(count($order_items) != count($carts)){
            foreach ($order_items ?? [] as $order_item){
                $a = null;
                foreach ($carts ?? [] as $cart){
                    if($order_item->item_id == $cart->attributes->item_id){
                        $a = 1;
                    }
                }
                if(!$a){
                    OrderItems::where('order_id', $id)->where('id', $order_item->id)->delete();
                }
            }
        }
    }

    public function getDay($data){
        $day = null;
        if($data){
            $m = date("m", strtotime($data));
            $d = date("d", strtotime($data));
            $y = date("Y", strtotime($data));
            $day = Calendar::where('day', $d)->where('month', $m)->where('year', $y)->first();
        }
        return $day;
    }
}
