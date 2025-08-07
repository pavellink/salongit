<div class="modal_block">
    <div class="modal" id="modal_form" style="background: rgba(0, 0, 0, 0.565);">
        <div class="modal_overlay"></div>
        <style>
            .modal{top:0;left:0;right:0;bottom:0;position:fixed;z-index:9999;display:flex;justify-content:center;align-items:normal}
            .modal_wrap{width:100%;display:flex;justify-content:center}
            .modal_wrap.center{align-items:center}
            .modal_scroll::-webkit-scrollbar{width:0}
            .modal_scroll{-ms-overflow-style:none;overflow:-moz-scrollbars-none;overflow-x:hidden;overflow-y:auto;width:100%}
            .modal_content{background:#fff;position:relative;overflow:hidden;z-index:200;border-radius:8px;margin:40px 20px}
            .modal_close{position:absolute;z-index:30;top:50%;margin-top:-11px;right:20px;display:inline-block;overflow:hidden;width:25px;height:25px;cursor:pointer;-webkit-transform:rotate(45deg);-ms-transform:rotate(45deg);transform:rotate(45deg)}
            .modal_wrap.center .modal_content{border-radius:25px}
            .modal_wrap.center .modal_close{top:15px;right:15px;margin-top:0}
            .modal_close::after,.modal_close::before{position:absolute;content:'';background:#bbb}
            .modal_close::after{top:0;bottom:0;left:50%;width:3px;margin-left:-1.5px}
            .modal_close::before{top:50%;right:0;left:0;height:3px;margin-top:-1.5px}
            .modal_head{width:100%;padding:20px;background:#e0f0ff;position:relative}
            .modal_head .title{font-size:16px;font-weight:600;display:flex;align-items:center}
            .title i{color:#64bcba;margin-right:10px;font-size:25px}
            .modal_body{padding:20px;font-size:16px;line-height:30px;color:#444}
            .modal_body .fas,.modal_body .far{color:#bbb;width:20px;font-size:15px}
            .modal_footer{padding:20px;border-top:1px solid #e6e6e6}
            .modal_footer .btn_modal_close{width:100%;padding:15px;font-size:14px;background:#64bcba;border:none;color:#fff;font-weight:600;border-radius:7px}
            .modal_overlay{position:absolute;width:100%;height:100%;z-index:100}
            .modal .phone{text-align:center;font-size:30px;font-weight:700;margin-bottom:15px;display:block;color:#222}
            .modal .user_time{text-align:center;font-size:16px;font-weight:600;margin-bottom:15px}
            .modal .phone_text{text-align:center;line-height:1.25;color:#666}
            .modal .phone_form{border-top:1px solid #bbb;margin-top:30px;padding-top:30px}
            .modal .phone_form_title{text-align:center;font-size:20px;font-weight:700;margin-bottom:15px}
            .modal .phone_form_btns{display:table;width:100%}
            .modal .form_btn{width:48%;display:inline-block;cursor:pointer;text-align:center;background:#e6effa;border-radius:25px;padding:10px;margin:1%;font-weight:600}
            .modal .form_btn:hover{background:#caddf4}
            .modal .logo{display:table;margin:15px auto 0;width: 75px}
            .modal .logo img{width: 100%;height: 100%;object-fit: contain}
        </style>
        <div class="modal_wrap">
            <div class="modal_scroll" style="max-width:850px">
                <div class="modal_content">
                    <div class="modal_head">
                        <div id="modal_close" class="modal_close modal_close_btn"></div>
                        <div class="title">Просмотр смены</div>
                    </div>
                    <div class="modal_body">
                        <div class="master">
                            <div class="master_image"><img src="/img/user.svg" alt=""></div>
                            <div class="master_info">{{$user->name}}</div>
                        </div>
                        <div class="orders">

                        </div>
                    </div>
                    <div class="modal_head">
                        <div class="title">Заказы</div>
                    </div>
                    <div class="modal_body">
                        <div class="">Заказов: {{$shift->count_orders ?? 0}} шт.</div>
                        <div class="">Сумма заказов: {{$shift->total_price ?? 0}} Р</div>
                    </div>
                    <div class="orders">
                        <style>
                            .orders{margin-bottom: 20px}
                            table {border-collapse: collapse;width: 100%;font-size: 16px;background: #fff;}
                            table, th {border-bottom: 1px solid #ddd;}

                            tr{border-bottom: 1px solid #ddd;}
                            tr:last-child{border-bottom: 0}
                            th, td{padding: 10px 20px; border-right: 1px solid #ddd}
                            th:last-child, td:last-child{border-right: 0}
                            thead{border-collapse: separate;border-top: 1px solid #ddd}
                            tbody{border-collapse: separate;}
                            td:first-child{padding-left: 20px}
                            td:last-child{padding-right: 20px}
                            .td_id{border-right: 1px solid #ddd;width: 75px;text-align: center}
                            .td_name{border-right: 1px solid #ddd}
                            .td_phone{border-right: 1px solid #ddd}
                            .td_acts{width: 75px;text-align: right}
                            .td_acts button{width: 100%;background: #bbb;color: #fff;padding: 6px 14px;border-radius: 4px;}
                            th input{width: 100%;padding: 5px;border: 1px solid #bbb;border-radius: 4px}
                            tr:nth-child(2n) {background:#f8fafc;}
                            .btn_show_phone{display: table;background: #ffffff;border-radius: 25px;color: #222;padding: 2px 8px;border: 1px solid #bbb;}

                            .add_form{margin: 0 20px 20px;}
                            .add_order{  border: 1px solid #2572fa;
                                text-align: center;
                                padding: 12px;
                                color: #2572fa;
                                font-weight: 600;
                                cursor: pointer;
                                border-radius: 8px;
                                width: 100%;
                                background: none;}
                            .add_order:hover{background: #2572fa;color: #fff}
                        </style>
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Время</th>
                                    <th>Услуга</th>
                                    <th>Клиент</th>
                                    <th>Телефон</th>
                                    <th>Сумма</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders ?? [] as $order)
                                <tr>
                                    <td class="td_checkbox">
                                        <input class="js_is_completed" type="checkbox" value="{{$order->id}}" {{$order->is_completed ? 'checked' : null}}>
                                    </td>
                                    <td>{{Helper::time($order->time_start)}} - {{Helper::time($order->time_finish)}}</td>
                                    <td>{{$order->title}}</td>
                                    <td>{{$order->user_name}}</td>
                                    <td>{{$order->user_phone}}</td>
                                    <td>{{$order->total}} Р</td>
                                    <td>
                                        <a href="{{route('orders.create', $order->id)}}" class="act"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                    <form action="{{route('orders.add')}}" class="add_form" >
                        <input type="hidden" name="shift_id" value="{{$shift->id}}">
                        <input type="hidden" name="master_id" value="{{$user->id}}">
                        <button type="submit" class="add_order">Добавить</button>
                    </form>

                </div>
            </div>
        </div>
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
