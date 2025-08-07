<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;
use App\Traits\CookieTrait;
use Cart;

class CartProductController
{
    public function add(Request $request)
    {
        $carts = Cart::session($request->cart_id)->getContent();
        $cart_id = $request->cart_id.'_'.time().'_'.rand(1000000, 9999999);

        Cart::session($request->cart_id)->add([
            'id' => $cart_id,
            'name' => 'Товар',
            'price' => 1,
            'quantity' => 1,
            'attributes' => [
                'section' => 'items',
            ],
        ]);

        return view('orders.components.cart_product', [
            'cart' => Cart::session($request->cart_id)->get($cart_id),
            'products' => Items::where('section', 'items')->with('subs')->whereNotNull('title')->whereNull('parent_id')->get()
        ]);
    }

    public function update(Request $request){

        $item = Items::where('id', $request->item_id)->first();

        Cart::session($request->cart_id)->update($request->cart_item_id, array(
            'name' => $item->title,
            'price' => $item->price,
            'attributes' => [
                'item_id' => $item->id,
                'section' => 'items',
            ]
        ));

        $items = Items::with('subs')->where('section', 'items')->whereNotNull('title')->whereNull('parent_id')->get();
        $cart = Cart::session($request->cart_id)->get($request->cart_item_id);

        return [
            'html' => view('orders.components.cart_product', ['cart' => $cart, 'products' => $items])->render()
        ];
    }

    public function updateCount(Request $request){
        Cart::session($request->cart_id)->update($request->cart_item_id, [
            'quantity' => $request->type == 'plus' ? 1 : -1,
        ]);

        return [
            'total' => Cart::session($request->cart_id)->getTotal(),
            'item_count' => Cart::session($request->cart_id)->get($request->cart_item_id)->quantity,
            'item_total' => Cart::session($request->cart_id)->get($request->cart_item_id)->getPriceSum()
        ];
    }

    public function delete(Request $request)
    {
        Cart::session($request->cart_id)->remove($request->cart_item_id);

        $carts = Cart::session($request->cart_id)->getContent();

        return [];
    }

    public function clearAll(Request $request)
    {
        Cart::session($this->cartCookie());
        Cart::clear();

        return 1;
    }
}
