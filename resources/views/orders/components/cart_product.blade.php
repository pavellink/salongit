<div class="input_group js_product" data-cart-id="{{$cart->id}}">
    <div class="row">
        <div class="col col-12 col-md-5">
            <select name="" id="" class="order_select" data-cart-item-id="{{$cart->id}}" required>
                <option value="">Выберите из списка</option>

                @forelse($products ?? [] as $product)
                    <option value="{{$product->id}}" style="font-weight: 600" {{$cart->attributes->item_id == $product->id ? 'selected' : null}} {{count($product->subs) > 0 ? 'disabled' : null}}>{{$product->title}} ({{$product->price}} руб.)</option>
                    @forelse($product->subs ?? [] as $sub)
                        <option value="{{$sub->id}}" {{$cart->attributes->item_id == $sub->id ? 'selected' : null}}>— {{$sub->title}} ({{$sub->price}} руб.)</option>
                    @empty
                    @endforelse
                @empty
                @endforelse
            </select>
        </div>
        <div class="col col-12 col-md-2">
            <div class="basket__total__price">
                <p><span class="item_total">{{$cart->price}}</span> <span class="price__tag">₽</span></p>
                <p>Цена за товар</p>
            </div>
        </div>
        <div class="col col-12 col-md-2">
            <div class="basket__buttons">
                <div class="basket__decrease__btn js_count" data-type="minus" data-cart-item-id="{{$cart->id}}"></div>
                <input type="text" value="{{$cart->quantity}}" data-max-count="100000" class="basket-quantity__input quantity_input js_count_input" disabled>
                <div class="basket__increase__btn js_count" data-type="plus" data-cart-item-id="{{$cart->id}}"></div>
            </div>
        </div>
        <div class="col col-12 col-md-2">
            <div class="basket__total__price">
                <p><span class="item_total js_item_total">{{$cart->price * $cart->quantity}}</span> <span class="price__tag">₽</span></p>
                <p>Общая сумма</p>
            </div>
        </div>
        <div class="col col-12 col-md-1">
            <div class="basket__delete" onclick="deleteProduct('{{$cart->id}}')">
                <div></div>
            </div>
        </div>
    </div>
</div>
