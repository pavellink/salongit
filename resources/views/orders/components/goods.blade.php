<div class="main_block">
    <style>
        .group_title{font-size:18px;font-weight:700;color:#222;line-height:1.25;margin-bottom:15px}
        .add_group_item{font-size:16px;display:table;font-weight:600;color:#2572fa}
        .input_group{margin-bottom:20px}
        .input_group .col{align-items:center;display:flex}
        .order_select{width:100%;padding:15px 20px;border-radius:10px;border:solid 1px #bbb}
        .order_select option:disabled{color:#222;font-weight:700}
        .basket__buttons{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center;justify-content:center}
        .basket__decrease__btn{background:url(/img/minus.svg) no-repeat center;width:20px;height:20px}
        .basket__buttons input{width:70px;height:42px;background:#F8F8F8;border-radius:4px;font-size:16px;margin:0 18px;text-align:center;font-family:"Open-Sans",sans-serif}
        .basket__increase__btn{background:url(/img/plus.svg) no-repeat center;width:20px;height:20px}
        .basket__total__price{display:table;margin:auto}
        .basket__total__price p:first-child{font-size:18px;font-weight:700;line-height:25px;text-align:center}
        .basket__total__price p:last-child{font-size:12px;color:#ACACAC;margin-top:4px;line-height:14px}
        .basket__delete{display:table;margin-left:auto}
        .basket__delete div{width:24px;height:24px;background:url(/img/basket-delete.svg) no-repeat center}
    </style>
    <div class="group_title">Товары </div>
    <div class="js_products">
        @forelse($carts ?? [] as $cart)
            @if($cart->attributes->section == 'items')
            @include('orders.components.cart_product')
            @endif
        @empty
        @endforelse
    </div>
    <div class="add_group_item" onclick="addProduct()">Добавить товар</div>
    <script>
        $('.js_products').on('click', '.js_count', function() {
            let cart_item_id = $(this).attr("data-cart-item-id");
            let type = $(this).attr("data-type");
            let parent = $(this).closest('.js_product');
            $.post('{{route('cart-product.update.count')}}', {cart_id: {{$cart_id}}, cart_item_id: cart_item_id, type: type, _token: '{!! csrf_token() !!}'}, function(data){
                console.log(data);
                parent.find('.js_count_input').val(data.item_count);
                parent.find('.js_item_total').html(data.item_total);
            });
        });


        function deleteProduct(id) {

            $.post('{{route('cart-product.delete')}}', {cart_id: {{$cart_id}}, cart_item_id: id, _token: '{!! csrf_token() !!}'}, function(data){
                $(".js_products").find("[data-cart-id='" + id + "']").remove()
            });
        }

        function addProduct() {
            $.post('{{route('cart-product.add')}}', {cart_id: {{$cart_id}}, _token: '{!! csrf_token() !!}'}, function(data){
                $('.js_products').append(data);
            });
        }
        $('.js_products').on('change', '.order_select', function() {
            let cart_item_id = $(this).attr("data-cart-item-id");
            $.post('{{route('cart-product.update')}}', {cart_id: {{$cart_id}}, cart_item_id: cart_item_id, item_id: $(this).val(), _token: '{!! csrf_token() !!}'}, function(data){
                $(".js_products").find("[data-cart-id='" + cart_item_id + "']").replaceWith(data.html)
            });
        });
    </script>
</div>
