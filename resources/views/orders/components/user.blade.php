<div class="main_block">
    <div class="row if_has_user">
        <div class="col-12 col-md-6">
            <div class=""><b>Имя</b></div>
            <div class="">{{$order->user_name}}</div>
        </div>
        <div class="col-12 col-md-6">
            <div class=""><b>Телефон</b></div>
            <div class="">{{Helper::phone($order->user_phone)}}</div>
        </div>
    </div>
</div>
