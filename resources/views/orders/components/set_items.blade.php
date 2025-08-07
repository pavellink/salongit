@forelse($setItems ?? [] as $key => $product)
    <div class="row set_block_item js_set_item">
        <div class="col col-12 col-md-5">
            {{$product['title']}}
        </div>
        <div class="col col-12 col-md-2">
            {{--{{$product['price']}} ₽--}}
        </div>
        <div class="col col-12 col-md-2">
            <div class="basket__buttons">
                <div class="basket__decrease__btn js_set_count" data-type="minus" data-set-item="{{$key}}" data-service="{{$cart->id}}"></div>
                <input type="text" value="{{$product['qty']}}" data-max-count="10000" class="basket-quantity__input quantity_input js_set_qty" disabled="">
                <div class="basket__increase__btn js_set_count" data-type="plus" data-set-item="{{$key}}" data-service="{{$cart->id}}"></div>
            </div>
        </div>
        <div class="col col-12 col-md-2 js_set_total">
            {{$product['price'] * $product['qty']}} ₽
        </div>
        <div class="col col-12 col-md-1">
            <div class="basket__delete js_set_delete" data-cart-item-id="{{$cart->id}}" data-set="{{$key}}">
                <div></div>
            </div>
        </div>
    </div>
@empty
@endforelse
