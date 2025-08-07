<div class="modal_block">
    <div class="modal_overlay"></div>
    <div class="modal2" id="modal_form">
        <div class="js_dialog"></div>

        <style>
            body{overflow: hidden}
            .modal2{top:0;right:0;bottom:0;position:fixed;z-index:9999;display:flex;justify-content:center;align-items:normal}

            .modal_wrap{width:100%;display:table;max-width:600px;max-width:600px}
            .modal_content{background:#fff;position:relative;overflow:hidden;z-index:200;box-shadow:-30px 0 30px 0 rgba(0,0,0,0.2);border-radius:12px 0 0 12px;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-flow:column nowrap;flex-flow:column nowrap;background-color:#fafbfb;position:relative;-webkit-font-smoothing:antialiased;min-height:100vh}
            .modal_close{position:absolute;z-index:30;top:20px;right:20px;display:inline-block;overflow:hidden;width:25px;height:25px;cursor:pointer;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg)}
            .modal_wrap.center .modal_content{border-radius:25px}
            .modal_wrap.center .modal_close{top:15px;right:15px;margin-top:0}
            .modal_close::after,.modal_close::before{position:absolute;content:'';background:#bbb}
            .modal_close::after{top:0;bottom:0;left:50%;width:3px;margin-left:-1.5px}
            .modal_close::before{top:50%;right:0;left:0;height:3px;margin-top:-1.5px}
            .modal_head{width:100%;background:#f7f8f9;position:relative;border-bottom:3px solid #bad3fd;padding:20px}
            .modal_head_title{font-size:20px;font-weight:900}
            .modal_body{font-size:16px;line-height:1.25;color:#444;-webkit-box-flex:1;-ms-flex:1 0 auto;flex:1 0 auto}
            .modal_overlay{position:fixed;width:100%;height:100%;z-index:100;left:0;background:rgba(0,0,0,0.25);top:0}
            main{display:flex;flex-direction:column;height:100vh}
            main header{height:110px;padding:30px 20px 30px 40px}
            #chat{padding-left:0;margin:0;list-style-type:none;overflow-y:scroll;font-size:14px;margin-bottom:70px}
            #chat li{padding:8px 20px;position:relative}

            #chat h2,#chat h3{display:inline-block;font-size:13px;font-weight:400;margin-bottom:0}
            #chat h3{color:#bbb;margin-bottom:0}
            #chat .message_wrap{padding:8px 12px;color:#222;line-height:1.25;max-width:85%;display:inline-block;text-align:left;border-radius:5px;position:relative}
            #chat .me{text-align:right}
            #chat .you .message_wrap{background-color:#e0f0ff}
            #chat .me .message_wrap{background-color:#e7fbce}
            #chat .triangle{width:0;height:0;border-style:solid;border-width:0 7px 7px;position:absolute;top:-7px}
            .message_name{color:#2572fa;font-weight:700;margin-bottom:4px}
            .message_date{color:#888;font-size:12px;margin-top:4px}
            #chat .me .message_date{margin-left:auto;display:table}
            main footer{padding:15px;border-top:3px solid #bad3fd;display:flex;align-items:end;background:#fff;position:absolute;bottom:0;left:0;width:100%}
            main footer svg{margin:8px;color:#a6aeb7;display:table;width:24px;height:24px}

            main footer textarea{resize:none;border: 1px solid #bbb;display:block;width:100%;height:40px;border-radius:8px;padding:12px;font-size:13px;margin-bottom:0;}
            main footer textarea::placeholder{color:#666}
            main footer img{height:30px;cursor:pointer}
            main footer a{text-decoration:none;text-transform:uppercase;font-weight:700;color:#6fbced;vertical-align:top;margin-left:333px;margin-top:5px;display:inline-block}

            .modal_head_info{background: #eee;padding: 15px;border-radius: 8px;}
            .info_item{display: flex;margin-bottom: 4px;justify-content: space-between}
            .info_item:last-child{margin-bottom: 0}
            .info_item_title{margin-right: 6px;font-weight: 600}
            .info_item_value{}

            .modal_order_data{padding: 20px 20px 10px}
            .order_data{display: flex;margin-bottom: 4px;gap: 6px;font-size: 14px}
            .order_data_title{font-weight: 600}
            .order_data_value{}
            .info_item_total_services{}
            .info_item_total{}
        </style>
        <div class="modal_wrap">
            <div class="modal_scroll" style="width:600px">
                <main class="modal_content">
                    <div id="modal_close" class="modal_close modal_close_btn"></div>
                    <div class="modal_head" style="background: none;">
                        <div class="modal_head_title">Заказ №{{$order->id}}</div>
                    </div>
                    <style>
                        .modal_order_btns{display: flex;justify-content: space-between;gap: 20px;margin: 20px 20px 10px}
                        .modal_order_btn{    padding: 15px 20px;background: #eee;font-size: 14px;cursor: pointer;border-radius: 8px;display: block}


                        .modal_user{display: flex;padding: 20px 20px 10px;font-size: 15px;gap: 20px;}
                        .modal_user_name{}
                        .modal_user_phone{}

                        .js_dialog_history{color: #0d6efd;cursor: pointer}
                    </style>
                    <div class="modal_order_btns">
                        <div class="modal_order_btn js_dialog_status {{Helper::color($order)}}">Статус: {{$status->title}}</div>
                        <div class="modal_order_btn js_dialog_pay">{{$order->status == 4 ? 'Оплачен' : 'Не оплачен'}}</div>
                        <form action="{{route('orders.delete', $order->id)}}" class="" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" value="{{$order->id}}">
                            <button class="modal_order_btn" onclick="return proverka();"><i class="fas fa-trash-alt"></i></button>
                        </form>
                        <a href="{{route('orders.create', $order->id)}}" class="modal_order_btn"><i class="fas fa-edit"></i></a>
                    </div>
                    <ul id="chat" class="js_chat">
                        <div class="modal_order_data">
                            <div class="order_data">
                                <div class="order_data_title">Клиент:</div>
                                <div class="order_data_value">{{$order->user_name}} — <span onclick="getContact({{$order->user_id}})">{{Helper::phone($order->user_phone)}}</span></div>
                            </div>
                            <div class="order_data">
                                <div class="order_data_title">История:</div>
                                <div class="order_data_value js_dialog_history">{{$history ?? 0}} посещений</div>
                            </div>
                            <div class="order_data" style="margin-bottom: 15px">
                                <div class="order_data_title"> @if($user->bonus_lvl){{$user->bonus_lvl->title ?? null}} {{'('.$user->bonus_lvl->percent.'%)' ?? null}}@else{{'Без уровня'}}@endif:</div>
                                <div class="order_data_value">{{$user->count_bonuses ?? 0}} баллов</div>
                            </div>
                            <div class="order_data">
                                <div class="order_data_title">Дата записи:</div>
                                <div class="order_data_value">{{Helper::date($order->date)}}</div>
                            </div>
                            <div class="order_data">
                                <div class="order_data_title">Время:</div>
                                <div class="order_data_value">{{Helper::time($order->time_start)}} - {{Helper::time($order->time_finish)}}</div>
                            </div>
                            <div class="order_data">
                                <div class="order_data_title">Мастер:</div>
                                <div class="order_data_value">{{$master ? $master->name : 'Мастер не определен'}}</div>
                            </div>
                            <div class="order_data">
                                <div class="order_data_title">Сумма заказа:</div>
                                <div class="order_data_value">{{$order->total}} руб.</div>
                            </div>
                            @if($order->paid_type)
                            <div class="order_data" style="margin-top: 15px">
                                <div class="order_data_title">Оплачено:</div>
                                <div class="order_data_value">{{$order->paid_amount}} руб. ({{$order->paid_type}})</div>
                            </div>
                            <div class="order_data">
                                <div class="order_data_title">Оплачено баллами:</div>
                                <div class="order_data_value">{{$order->paid_bonus}} руб.</div>
                            </div>
                            @endif
                        </div>
                        @forelse($items ?? [] as $item)
                        <li class="system">
                            <div class="modal_head_info">
                                <div class="info_item">
                                    <div class="info_item_title">{{$item->service && $item->service->parent ? $item->service->parent->title.': ' : null}}{{$item->title}}</div>
                                    <div class="info_item_total">@if($item->total_services != $item->total)({{$item->total_services}}/{{$item->total - $item->total_services}})&nbsp;@endif<b>{{$item->total}}</b> руб.</div>
                                </div>
                                <style>
                                    .info_subs{display: flex;flex-direction: column;gap: 8px;margin-top: 15px}
                                    .info_subitem{display: flex;justify-content: space-between;}
                                    .info_subitem_title{width: 50%}
                                    .info_subitem_qty{width: 75px}
                                    .info_subitem_total{width: 100px;text-align: right}
                                </style>

                                @if($item->products)
                                    <div class="info_subs">
                                    @forelse(json_decode($item->products) ?? [] as $sub)
                                        <div class="info_subitem">
                                        <div class="info_subitem_title">{{$sub->title}}</div>
                                        <div class="info_subitem_qty">{{$sub->qty}} (г/шт)</div>
                                        <div class="info_subitem_total">{{$sub->qty * $sub->price}} руб.</div>
                                        </div>
                                    @empty
                                    @endforelse
                                    </div>
                                @endif
                            </div>
                        </li>
                        @empty
                        @endforelse
                        @forelse($messages ?? [] as $item)
                        <li class="{{Auth::id() != $item->user_id ? 'you' : 'me'}}">
                            <div class="message_wrap">
                                @if(Auth::id() != $item->user_id)
                                <div class="message_name">{{$item->user_name}}</div>
                                @endif
                                <div class="message">
                                    {!! nl2br($item->descr) !!}
                                </div>
                                <div class="message_date">{{Helper::datetime($item->created_at)}}</div>
                            </div>
                        </li>
                        @empty
                        @endforelse
                    </ul>
                    <footer>
                        <textarea class="js_textarea" placeholder="Напишите сообщение..."></textarea>
                        <svg class="js_send" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="send_24__Page-2" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="send_24__send_24"><path id="send_24__Rectangle-76" d="M0 0h24v24H0z"></path><path d="M5.74 15.75a39.14 39.14 0 0 0-1.3 3.91c-.55 2.37-.95 2.9 1.11 1.78 2.07-1.13 12.05-6.69 14.28-7.92 2.9-1.61 2.94-1.49-.16-3.2C17.31 9.02 7.44 3.6 5.55 2.54c-1.89-1.07-1.66-.6-1.1 1.77.17.76.61 2.08 1.3 3.94a4 4 0 0 0 3 2.54l5.76 1.11a.1.1 0 0 1 0 .2L8.73 13.2a4 4 0 0 0-3 2.54Z" id="send_24__Mask" fill="currentColor"></path></g></g></svg>
                        <script>
                            var objDiv = document.getElementById("chat");
                            objDiv.scrollTop = objDiv.scrollHeight;

                            $('.js_send').on('click', function (){
                                let val = $('.js_textarea').val();
                                $.post('{{route('messages.add')}}', {descr: val, order_id: {{$order->id}}, _token: '{!! csrf_token() !!}'}, function(data){
                                    $('.js_chat').append(data);
                                    $('.js_textarea').val('');
                                    $('.js_textarea').css("height", "40px");

                                    var objDiv = document.getElementById("chat");
                                    objDiv.scrollTop = objDiv.scrollHeight;
                                });
                            });

                            var tx = document.getElementsByTagName('textarea');//РАСТЯГИВАЕМ_textarea
                            for (var i = 0; i < tx.length; i++) {
                                tx[i].setAttribute('style', 'height:' + (tx[i].scrollHeight) + 'px;overflow-y:hidden;');
                                tx[i].addEventListener("input", OnInput, false);
                            }

                            function OnInput() {
                                this.style.height = 'auto';
                                this.style.height = (this.scrollHeight) + 'px';//////console.log(this.scrollHeight);
                            }
                        </script>
                    </footer>
                </main>
            </div>
        </div>
        <script>
            function proverka() {
                if (confirm("Подтвердить удаление?")) {
                    return true;
                } else {
                    return false;
                }
            }

            $('.js_dialog_status').on('click', function (){
                $.get('{{route('modal.dialog.status')}}', {order_id: '{{$order->id}}'}, function(data){
                    console.log(data);
                    $('.js_dialog').html(data);
                });
            });
            $('.js_dialog_pay').on('click', function (){
                $.get('{{route('modal.dialog.pay')}}', {order_id: '{{$order->id}}'}, function(data){
                    console.log(data);
                    $('.js_dialog').html(data);
                });
            });
            $('.js_dialog_history').on('click', function (){
                $.get('{{route('modal.dialog.history')}}', {order_id: '{{$order->id}}'}, function(data){
                    console.log(data);
                    $('.js_dialog').html(data);
                });
            });
            $('.js_dialog').on('click', '.js_dialog_close', function (){
                $('.js_dialog').html('');
            });

            $('.js_dialog').on('click', '.js_select_status', function (){
                let status_id = $(this).attr('data-status');
                $.post('{{route('orders.change.status')}}', {status_id:status_id, order_id:'{{$order->id}}', _token: '{!! csrf_token() !!}'}, function(data){
                    console.log(data);
                    updateModalOrder();
                });
            });

            function updateModalOrder(){
                $.get('{{route('modal.order.view')}}', {order_id: '{{$order->id}}'}, function(data){
                    $('.app_modal').html(data);
                });
            }
        </script>
        <script>
            $('.modal_block').on('click', '.modal_close_btn', function(){
                $('#modal_form').remove();
            });
            $('.modal_block').on('click', '.modal_overlay', function(){
                $('#modal_form').remove();
            });
        </script>
    </div>
</div>
