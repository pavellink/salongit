<div class="modal_dialog">
    <div class="modal_dialog_header">
        <div class="modal_dialog_header_title">Статус заказа</div>
        <div class="modal_dialog_close js_dialog_close"><i class="fal fa-angle-right"></i></div>
    </div>
    @if(!$order->paid_type)
    <div class="modal_dialog_btns">
        @forelse($statuses ?? [] as $groups)
        <div class="modal_dialog_btn_group">
            @forelse($groups ?? [] as $status)
            <div class="modal_dialog_btn js_select_status {{$order->status == $status->type ? 'checked' : null}}" data-status="{{$status->id}}">{{$status->title}}</div>
            @empty
            @endforelse
        </div>
        @empty
        @endforelse
    </div>
    @else
        <div class="modal_dialog_text">
            Заказ уже оплачен
        </div>
    @endif
</div>
