<section class="task {{Helper::color($order)}}" onclick="viewOrder({{$order->id}})" style="grid-column: {{$loop->parent->parent->iteration + 1}};grid-row: {{Helper::rowTime($order->time_start)}}{{'/'}}{{Helper::rowTime($order->time_finish)}};">
    <div class="task-1 {{Helper::colorBorder($order)}}"></div>
    <div class="task_info">
        <div class="task_time">{{Helper::time($order->time_start)}} - {{Helper::time($order->time_finish)}}</div>
        <div class="task_title">{{$order->title}}</div>
        <div class="task_user">
            @if($order->user_id)
                <span>{{$order->user_name}}</span>
                <span class="btn_show_phone">{{Helper::phone($order->user_phone)}}</span>
            @else
                <a href="{{route('orders.create', $order->id)}}" target="_blank">Указать пользователя</a>
            @endif
        </div>
    </div>
</section>
