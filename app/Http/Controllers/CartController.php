<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Models\SetItems;
use App\Traits\CookieTrait;
use Cart;
use App\Models\Items;
use Illuminate\Http\Request;

class CartController
{
    public function add(Request $request)
    {
        $carts = Cart::session($request->cart_id)->getContent();
        $cart_id = $request->cart_id.'_'.time().'_'.rand(1000000, 9999999);

        Cart::session($request->cart_id)->add([
            'id' => $cart_id,
            'name' => 'Услуга',

            'price' => 1,
            'quantity' => 1,
            'attributes' => [
                'section' => 'services',
            ],
        ]);

        $items = Services::with('subs')->whereNotNull('title')->whereNull('parent_id')->get();
        $cart = Cart::session($request->cart_id)->get($cart_id);

        return view('orders.components.cart_item', [
            'cart' => $cart,
            'items' => $items
        ]);
    }

    public function update(Request $request){

        $item = Services::where('id', $request->item_id)->first();

        //dd($item);
        Cart::session($request->cart_id)->update($request->cart_item_id, array(
            'name' => $item->title,
            'price' => $item->price,
            'mins' => $item->mins,
            'attributes' => [
                'item_id' => $item->id,
                'section' => 'services',
            ],
            'items' => null,
            'set_service' => null,
            'set_total' => null
        ));

        $items = Services::with('subs')->whereNotNull('title')->whereNull('parent_id')->get();

        $carts = Cart::session($request->cart_id)->getContent();
        $mins = 0;
        foreach ($carts ?? [] as $cart){
            $mins = $mins + ($cart->mins * $cart->quantity);
            $cart->service = Services::with('setService.set')->where('id', $cart->attributes->item_id)->first();
        }

        return [
            'mins' => $mins,
            'html' => view('orders.components.cart_item', ['cart' => $cart, 'items' => $items])->render()
        ];
    }

    public function updateCount(Request $request){
        Cart::session($request->cart_id)->update($request->cart_item_id, [
            'quantity' => $request->type == 'plus' ? 1 : -1,
        ]);

        $carts = Cart::session($request->cart_id)->getContent();
        $mins = 0;
        foreach ($carts ?? [] as $cart){
            $mins = $mins + ($cart->mins * $cart->quantity);
        }

        $cart = Cart::session($request->cart_id)->get($request->cart_item_id);
        $cart->service = Services::with('setService.set')->where('id', $cart->attributes->item_id)->first();
        $items = Services::with('subs')->whereNotNull('title')->whereNull('parent_id')->get();

        return [
            'mins' => $mins,
            'html' => view('orders.components.cart_item', ['cart' => $cart, 'items' => $items])->render()
        ];
    }

    public function createSet(Request $request){
        //dd($request->all());
        $cart = Cart::session($request->cart_id)->get($request->cart_item_id);
        //dd($cart);
        $products = Items::get();
        return view('orders.components.set_create', [
            'cart' => $cart,
            'products' => $products
        ]);
    }

    public function storeSet(Request $request){
        //dd($request->all());
        $cart = Cart::session($request->cart_id)->get($request->cart_item_id);
        //dd($cart->items);
        if($cart->items){
            $array = $cart->items;
        } else {
            $array = [];
        }
        $product = Items::where('id', $request->product_id)->first();

        $array = array_merge($array, ['0_'.$product->id => [
            'id' => 'i_'.$product->id,
            //'service_id' => $item->service_id,
            'item_id' => $product->id,
            'step' => $product->step,
            'title' => $product->title,
            'price' => $product->price,
            'qty' => $product->step ?? 0,
        ]
        ]);

        Cart::session($request->cart_id)->update($request->cart_item_id, array(
            'items' => $array
        ));

        $this->totalSet($request->cart_id, $request->cart_item_id);

        return $this->returnItem($request->cart_id, $request->cart_item_id);
    }

    public function changeSet(Request $request){
        //dd($request->all());
        $cart = Cart::session($request->cart_id)->get($request->cart_item_id);
        $setItems = SetItems::where('set_service_id', $request->set_service_id)->get();
        //dd($setItems);
        $array = [];
        foreach ($setItems ?? [] as $item){
            //dd($item);
            $product = Items::where('id', $item->item_id)->first();
            if($product){
            $array = array_merge($array, [$item->set_id.'_'.$item->item_id => [
                    'id' => $item->set_id.'_'.$item->item_id,
                    'set_id' => $item->set_id,
                    'set_service_id' => $item->set_service_id,
                    'service_id' => $item->service_id,
                    'item_id' => $item->item_id,
                    'step' => $product->step,
                    'title' => $product->title,
                    'price' => $product->price,
                    'qty' => $item->qty,
                ]
            ]);
            }
            //dd($array);
        }
        Cart::session($request->cart_id)->update($request->cart_item_id, array(
            'items' => $array, // new item name
            'set_service' => $request->set_service_id,
            'set_total' => null
        ));
        //dd($array);
        $this->totalSet($request->cart_id, $request->cart_item_id);
        return $this->returnItem($request->cart_id, $request->cart_item_id);
    }

    public function updateSet(Request $request){
        //dd($request->all());
        $cart = Cart::session($request->cart_id)->get($request->cart_item_id);

        $array = $cart->items;
        if(isset($array[$request->set_item_id])){
            //dd($array[$request->set_item_id]['qty']);
            if($request->type == 'plus'){
                $qty = $array[$request->set_item_id]['qty'] + $array[$request->set_item_id]['step'];
                //$qty = 1;
                //dd($qty);
            } else if($request->type == 'minus'){
                $qty = $array[$request->set_item_id]['qty'] - $array[$request->set_item_id]['step'];
                if($qty < 0){
                    $qty = 0;
                }
            }
            $array[$request->set_item_id]['qty'] = $qty;
            //$array[$request->set_item_id]['total'] = $qty * ;
            //$array[$request->set_item_id]['qty']
            //dd($array[$request->set_item_id]);
        }
        Cart::session($request->cart_id)->update($request->cart_item_id, array(
            'items' => $array, // new item name
        ));
        //dd($array);
        $this->totalSet($request->cart_id, $request->cart_item_id);

        return $this->returnItem($request->cart_id, $request->cart_item_id);
    }

    public function deleteSet(Request $request){
        //dd($request->all());
        $cart = Cart::session($request->cart_id)->get($request->cart_item_id);
        //dd($cart->items);

        if($cart->items){
            $array = $cart->items;
            unset($array[$request->set_id]);
        } else {
            $array = null;
        }

        Cart::session($request->cart_id)->update($request->cart_item_id, array(
            'items' => $array
        ));

        $this->totalSet($request->cart_id, $request->cart_item_id);

        return $this->returnItem($request->cart_id, $request->cart_item_id);
    }

    static function totalSet($cart_id, $cart_item_id){
        $cart = Cart::session($cart_id)->get($cart_item_id);

        $total = 0;
        foreach ($cart->items ?? [] as $item){
            $total = $total + ($item['price'] * $item['qty']);
        }

        Cart::session($cart_id)->update($cart_item_id, array(
            'set_total' => $total
        ));

        return true;
    }

    static function returnItem($cart_id, $cart_item_id){
        $cart = Cart::session($cart_id)->get($cart_item_id);
        $cart->service = Services::with('setService.set')->where('id', $cart->attributes->item_id)->first();
        $items = Services::with('subs')->whereNotNull('title')->whereNull('parent_id')->get();

        return view('orders.components.cart_item', ['cart' => $cart, 'items' => $items]);
    }

    public function delete(Request $request)
    {
        Cart::session($request->cart_id)->remove($request->cart_item_id);

        $carts = Cart::session($request->cart_id)->getContent();
        $mins = 0;
        foreach ($carts ?? [] as $cart){
            $mins = $mins + ($cart->mins * $cart->quantity);
        }

        return [
            'mins' => $mins,
        ];
    }

    public function clearAll(Request $request)
    {
        Cart::session($this->cartCookie());
        Cart::clear();

        return 1;
    }
}
