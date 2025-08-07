<div class="modal_dialog">
    <div class="modal_dialog_header">
        <div class="modal_dialog_header_title">История посещений</div>
        <div class="modal_dialog_close js_dialog_close"><i class="fal fa-angle-right"></i></div>
    </div>
    <style>
        .modal_dialog_histories{padding: 20px;display: flex;flex-direction: column;gap: 8px}
        .modal_dialog_history{padding: 12px 15px;border-radius: 8px;display: flex;cursor: pointer;flex-direction: column;gap: 4px;position: relative}
        .modal_dialog_history_border{position: absolute;top: 0px;bottom: 0px;width: 4px;border-radius: 25px;left: 0px;}
        .modal_dialog_history_title{font-size: 15px;font-weight: 600;line-height: 1.25;}
        .modal_dialog_history_date{font-size: 14px;color: #888;}
    </style>
    <div class="modal_dialog_histories">
        @forelse($orders ?? [] as $order)
        <div class="modal_dialog_history {{Helper::color($order)}}" onclick="viewOrder({{$order->id}})">
            <div class="modal_dialog_history_border {{Helper::colorBorder($order)}}"></div>
            <div class="modal_dialog_history_title">{{$order->title}}</div>
            <div class="modal_dialog_history_date">{{Helper::datetime($order->date.' '.$order->time_start)}}</div>
        </div>
        @empty
        @endforelse
    </div>
</div>
<script>

</script>
