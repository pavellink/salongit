<div class="row set_block_item js_set_item">
    <div class="col col-12 col-md-5">
        <select class="set_create js_set_store" name="product_id" data-cart-item-id="{{$cart->id}}">
            <option value="">Выберите из списка</option>
            @forelse($products ?? [] as $product)
            <option value="{{$product->id}}">{{$product->title}}</option>
            @empty
            @endforelse
        </select>
    </div>
    <div class="col col-12 col-md-2">
    </div>
    <div class="col col-12 col-md-2">
    </div>
    <div class="col col-12 col-md-2 js_set_total">
    </div>
    <div class="col col-12 col-md-1">
    </div>
</div>
