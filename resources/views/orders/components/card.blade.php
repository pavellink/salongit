<div class="main_block">
    <style>
        .group_title{font-size:18px;font-weight:700;color:#222;line-height:1.25;margin-bottom:15px}
        .add_group_item{font-size:15px;display:table;font-weight:600;color:#2572fa}
        .input_group{margin-bottom:20px}
        .input_group_item > div{justify-content: center;}
        .input_group_item > div:first-child{justify-content: left;}
        .input_group_item > div:last-child{justify-content: right;}
        .input_group .col{align-items:center;display:flex}
        .order_select{width:100%;padding:15px 20px;border-radius:10px;border:solid 1px #bbb}
        .order_select option:disabled{color:#222;font-weight:700}
        .basket__buttons{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center;justify-content:center}
        .basket__decrease__btn{background:url(/img/minus.svg) no-repeat center;width:20px;height:20px}
        .basket__buttons input{width:70px;height:42px;background:#F8F8F8;border-radius:4px;font-size:16px;margin:0 18px;text-align:center;font-family:"Open-Sans",sans-serif}
        .basket__increase__btn{background:url(/img/plus.svg) no-repeat center;width:20px;height:20px}
        .basket__total__price{display:table;margin:auto}
        .basket__total__price p:first-child{font-size:18px;font-weight:700;line-height:25px;text-align:center}
        .basket__total__price p:last-child{font-size:12px;color:#ACACAC;margin-top:4px;line-height:14px;text-align: center}
        .basket__delete{display:table;margin-left:auto}
        .basket__delete div{width:24px;height:24px;background:url(/img/basket-delete.svg) no-repeat center}
    </style>


    <style>
        .set_block_wrap{    margin: 0 -40px 30px;
            padding: 20px 40px 30px;
            border-bottom: 3px solid #e0f0ff;
          }
        .set_block{    padding: 20px 30px;
            background: #f5f5f5;
            border-radius: 8px;}

        .set_sets{    display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;}
        .set_set{padding: 10px 15px;border: 1px solid #bbb;border-radius: 8px;cursor: pointer;font-size: 14px}
        .set_set:hover{background: #2572fa;color: #fff;border-color: #2572fa}
        .set_set.active{background: #2572fa;color: #fff;border-color: #2572fa}

        .set_create{    padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;}

        .set_block_items{}
        .set_block_item{margin-bottom: 8px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 8px;}
        .set_block_item .basket__buttons input{background: #fff;width: 60px;
            height: 40px;}

        .set_block_thead > div{justify-content: center;font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;}
        .set_block_thead > div:first-child{justify-content: left;}
        .set_block_thead > div:last-child{justify-content: right;}

        .set_block_item > div{justify-content: center;font-size: 16px;}
        .set_block_item > div:first-child{justify-content: left;}
        .set_block_item > div:last-child{justify-content: right;}
    </style>

    <div class="group_title">Услуги <span class="js_mins" style="display: {{$mins > 0 ? 'initial' : 'none'}};font-weight: 400">(<span class="js_count_mins">{{$mins / 60}}</span> ч.)</span></div>
    <div class="js_cart">
        @forelse($carts ?? [] as $cart)
            @include('orders.components.cart_item')
        @empty
        @endforelse
    </div>
    <div class="add_group_item" onclick="addCart()">Добавить услугу</div>
    <script>
        $('.js_cart').on('click', '.js_count', function() {
            let cart_item_id = $(this).attr("data-cart-item-id");
            let type = $(this).attr("data-type");
            let parent = $(this).closest('.js_cart_item');
            $.post('{{route('cart.update.count')}}', {cart_id: {{$cart_id}}, cart_item_id: cart_item_id, type: type, _token: '{!! csrf_token() !!}'}, function(data){
                console.log(data);
                $('.js_mins').show();
                $('.js_count_mins').html(data.mins / 60);
                $('.js_input_mins').val(data.mins);
                parent.html(data.html);
            });
        });


        function deleteItem(id) {

            $.post('{{route('cart.delete')}}', {cart_id: {{$cart_id}}, cart_item_id: id, _token: '{!! csrf_token() !!}'}, function(data){
                $('.js_mins').show();
                $('.js_count_mins').html(data.mins / 60);
                $('.js_input_mins').val(data.mins);
                $(".js_cart").find("[data-cart-id='" + id + "']").remove()
            });
        }

        function addCart() {
            $.post('{{route('cart.add')}}', {cart_id: {{$cart_id}}, _token: '{!! csrf_token() !!}'}, function(data){
                $('.js_cart').append(data);
            });
        }
        $('.js_cart').on('change', '.js_select', function() {
            let cart_item_id = $(this).attr("data-cart-item-id");
            $.post('{{route('cart.update')}}', {cart_id: {{$cart_id}}, cart_item_id: cart_item_id, item_id: $(this).val(), _token: '{!! csrf_token() !!}'}, function(data){
                $('.js_mins').show();
                $('.js_count_mins').html(data.mins / 60);
                $('.js_input_mins').val(data.mins);
                $(".js_cart").find("[data-cart-id='" + cart_item_id + "']").replaceWith(data.html)
            });
        });

        $('.js_cart').on('click', '.js_set_create', function (){

            let cart_item_id = $(this).attr('data-cart-item-id');
            console.log(cart_item_id);
            let parent = $(this).closest('.js_cart_item');
            $.post('{{route('cart.createSet')}}', {cart_id: {{$cart_id}}, cart_item_id: cart_item_id, _token: '{!! csrf_token() !!}'}, function(data){
                parent.find('.js_set_items').append(data);
                //console.log(data);
            });
        })

        $('.js_cart').on('change', '.js_set_store', function (){

            let cart_item_id = $(this).attr('data-cart-item-id');
            let product_id = $(this).val();
            //console.log(cart_item_id);
            let parent = $(this).closest('.js_cart_item');
            $.post('{{route('cart.storeSet')}}', {cart_id: {{$cart_id}}, cart_item_id: cart_item_id, product_id:product_id, _token: '{!! csrf_token() !!}'}, function(data){
                //parent.find('.js_set_items').append(data);
                parent.html(data);
                //console.log(data);
            });
        })

        $('.js_cart').on('click', '.js_set_delete', function (){

            let cart_item_id = $(this).attr('data-cart-item-id');
            let set_id = $(this).attr('data-set');
            //console.log(cart_item_id);
            let parent = $(this).closest('.js_cart_item');
            $.post('{{route('cart.deleteSet')}}', {cart_id: {{$cart_id}}, cart_item_id: cart_item_id, set_id:set_id, _token: '{!! csrf_token() !!}'}, function(data){
                //parent.find('.js_set_items').append(data);
                parent.html(data);
                //console.log(data);
            });
        })

        $('.js_cart').on('click', '.js_set_change', function (){
            $('.js_set_change').removeClass('active');
            $(this).addClass('active');
            let set_service_id = $(this).attr('data-set');
            let cart_item_id = $(this).attr('data-cart-item');
            let parent = $(this).closest('.js_cart_item');
            $.post('{{route('cart.changeSet')}}', {cart_id: {{$cart_id}}, set_service_id: set_service_id, cart_item_id: cart_item_id, _token: '{!! csrf_token() !!}'}, function(data){
                parent.html(data);
                console.log(data);
            });
        });

        $('.js_cart').on('click', '.js_set_count', function() {
            let cart_item_id = $(this).attr("data-service");
            let set_item_id = $(this).attr("data-set-item");
            let type = $(this).attr("data-type");
            let parent = $(this).closest('.js_cart_item');
            $.post('{{route('cart.updateSet')}}', {cart_id: {{$cart_id}}, cart_item_id: cart_item_id, set_item_id: set_item_id, type: type, _token: '{!! csrf_token() !!}'}, function(data){
                console.log(data);
                parent.html(data);
                //parent.find('.js_set_qty').val(data.set_qty);
                //parent.find('.js_set_total').html(data.set_total);
            });
        });
    </script>
</div>
