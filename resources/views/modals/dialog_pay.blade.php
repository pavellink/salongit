<div class="modal_dialog">
    <div class="modal_dialog_header">
        <div class="modal_dialog_header_title">Способ оплаты</div>
        <div class="modal_dialog_close js_dialog_close"><i class="fal fa-angle-right"></i></div>
    </div>
    <style>

        .modal_dialog_pay_check{display: none}

        .dialog_pay_block.hide{display: none}
        .dialog_pay_block.show{display: block!important;}
        .dialog_pay_block.show .modal_dialog_pay_check{display: flex;flex-direction: column;gap: 8px;margin-bottom: 60px;    margin-top: 15px;font-size: 16px}
        .modal_dialog_pay_check_title{}
        .modal_dialog_pay_confirm{padding: 15px 20px;font-size: 15px;border-radius: 8px;background: #e6e6e6;cursor:pointer}
        .modal_dialog_pay_confirm:hover{background: #2572fa;color: #fff;}
        .modal_pay_confirm{color: #0d6efd;
            cursor: pointer;font-size: 16px}
    </style>
    @if(!$order->paid_type)
    <div class="modal_dialog_pays">
        <div class="dialog_pay_block js_pay">
            <div class="modal_dialog_pay js_nal">Наличные (копим баллы)</div>
            <div class="modal_dialog_pay_check js_check_nal">
                <div class="modal_dialog_pay_check_title">К оплате <b>{{$order->total}}</b> рубля.</div>
                <div class="modal_pay_confirm js_check_pay" data-bonus="0" data-type="nal" data-sum="{{$order->total}}">Подтвердить оплату</div>
    <!--            <div class="modal_dialog_pay_confirm">Оплата получена, заказ закрыт</div>-->
            </div>
        </div>
        @if(!$user->bonus_ban)
        <div class="dialog_pay_block js_pay">
            <div class="modal_dialog_pay js_nal">Наличные (списать)</div>
            <div class="modal_dialog_pay_check js_check_nal">
                <div class="modal_dialog_pay_check_title">Сумма <b>{{$order->total}}</b> рубля.</div>
                <div class="modal_dialog_pay_bonus">Спишется баллами <b>{{$available}}</b> рубля.</div>
                <div class="modal_dialog_pay_check_title">К оплате <b>{{$order->total - $available}}</b> рубля.</div>
                <div class="modal_pay_confirm js_check_pay" data-bonus="{{$available}}" data-type="nal" data-sum="{{$order->total - $available}}">Подтвердить оплату</div>
                <!--            <div class="modal_dialog_pay_confirm">Оплата получена, заказ закрыт</div>-->
            </div>
        </div>
        @endif
        <div class="dialog_pay_block">
            <div class="modal_dialog_pay js_qr">QR-код (копим баллы)</div>
        </div>
        @if($available > 0 && !$user->bonus_ban)
        <div class="dialog_pay_block">
            <div class="modal_dialog_pay js_qr_bonus">QR-код (списать баллы)<br>Можно списать: <b>{{$available}}</b> б.</div>
        </div>
        @endif
    </div>
    @else
        <div class="modal_dialog_text">
            Заказ уже оплачен
        </div>
    @endif
</div>
<script>
    $('.js_check_pay').on('click', function (){
        if (confirm("Подтвердить оплату?")) {
            let bonus = $(this).attr('data-bonus');
            console.log(bonus);
            let type = $(this).attr('data-type');
            console.log(type);
            let sum = $(this).attr('data-sum');
            console.log(sum);
            $.post('{{route('orders.confirm.nal')}}', {order_id:'{{$order->id}}', sum:sum, bonus:bonus, type:type, _token: '{!! csrf_token() !!}'}, function(data){
                console.log(data);
                updateModalOrder();
            });
        } else {
            return false;
        }
    });

    $('.js_nal').on('click', function (){
        let parent = $(this).closest('.js_pay');
        if (parent.hasClass('show')) {
            $('.dialog_pay_block').removeClass('hide');
            parent.removeClass('show');
        } else {
            $('.dialog_pay_block').addClass('hide');
            parent.addClass('show');
        }
        //parent.find('.js_check_nal').toggleClass('show');
        //$('.js_check_nal').toggleClass('show');
    });
    $('.js_qr').on('click', function (){
        $('.js_check_qr').toggleClass('show');
    });

</script>
