<div class="input_group js_cart_item" data-cart-id="{{$cart->id}}">
    <div class="row input_group_item">
        <div class="col col-12 col-md-5">
            <select name="" id="" class="order_select js_select" data-cart-item-id="{{$cart->id}}" required>
                <option value="">Выберите из списка</option>
                @forelse($items ?? [] as $item)
                    <option value="{{$item->id}}" style="font-weight: 600" {{$cart->attributes->item_id == $item->id ? 'selected' : null}} {{count($item->subs) > 0 ? 'disabled' : null}}>{{$item->title}} ({{$item->price}} руб.)</option>
                    @forelse($item->subs ?? [] as $sub)
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
                <p>Цена за услугу</p>
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
                <p><span class="item_total js_item_total">{{$cart->price * $cart->quantity}}</span> <span class="price__tag">₽</span>@if($cart->set_total) / {{$cart->set_total + ($cart->price * $cart->quantity)}} ₽@endif</p>
                <p>Общая сумма</p>
            </div>
        </div>
        <div class="col col-12 col-md-1">
            <div class="basket__delete" onclick="deleteItem('{{$cart->id}}')">
                <div></div>
            </div>
        </div>
    </div>
    @if($cart->service && $cart->service->is_set)
        <div class="set_sets">
            @forelse($cart->service->setService ?? [] as $setService)
                @if($setService->set)
            <div class="set_set js_set_change {{$cart->set_service == $setService->id ? 'active' : null}}" data-set="{{$setService->id}}" data-cart-item="{{$cart->id}}">
                <div class="set_set_title">{{$setService->set->title}}</div>
            </div>
                @endif
            @empty
            @endforelse
        </div>
    <div class="set_block_wrap">
    <div class="set_block">
        <div class="row set_block_thead">
            <div class="col col-12 col-md-5">
                <div class="set_block_title">Товары</div>
            </div>
            <div class="col col-12 col-md-2">
                <!--Цена-->
            </div>
            <div class="col col-12 col-md-2">
                Расход г./шт.
            </div>
            <div class="col col-12 col-md-2">
                Сумма
            </div>
            <div class="col col-12 col-md-1">

            </div>
        </div>
        <div class="set_block_items js_set_items">
            @if($cart->items)
                @include('orders.components.set_items', ['setItems' => $cart->items])
            @endif
        </div>

        <div class="row set_block_item">
            <div class="col col-12 col-md-5">
                <div class="add_group_item js_set_create" data-cart-item-id="{{$cart->id}}">Добавить товар</div>
            </div>
            <div class="col col-12 col-md-2">

            </div>
            <div class="col col-12 col-md-2">

            </div>
            <div class="col col-12 col-md-2">
                <b><span class="js_set_total">{{$cart->set_total}}</span> ₽</b>
            </div>
            <div class="col col-12 col-md-1">

            </div>
        </div>

    </div>
    </div>
    @endif
</div>
