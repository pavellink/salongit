@extends('app')
@section('content')
    @widget('aside', ['page' => 3])
    <div class="page_content" style="background: #fff">
        <div class="main_block">
            <h1 class="page_title">{{$order->in_progress == 1 ? 'Новый заказ' : 'Редактирование заказа №'.$order->id}}</h1>
        </div>

        <form action="{{route('orders.store', $order->id)}}" id="new_order" method="POST">
            {{ csrf_field() }}
            <input type="hidden" class="js_shift_id" name="shift_id" value="{{$order->shift_id}}">
            <input type="hidden" class="js_input_mins" name="mins" value="{{$mins}}">
            @if(!$order->user_id)
            <div class="main_block js_user_replacement">
                <style>
                    .find_radio_block{margin-bottom: 20px}
                    .find_radio{display:inline-block;margin-right:4px}
                    .find_radio input[type=radio]{display:none}
                    .find_radio label{display:inline-block;cursor:pointer;padding:10px 20px;line-height:1.25;border:1px solid #bbb;border-radius:10px;user-select:none;font-size: 16px}
                    .find_radio input[type=radio]:checked + label{background:#2572fa;color:#fff;border:1px solid #2572fa}
                    .find_radio label:hover{color:#666}
                    .find_radio input[type=radio]:disabled + label{background:#efefef;color:#666}
                </style>
                <div class="find_radio_block">
                    <div class="find_radio">
                        <input id="find-radio-1" type="radio" name="find_or_new" value="1" checked onchange="changeFindNew()">
                        <label for="find-radio-1">Поиск клиента</label>
                    </div>
                    <div class="find_radio">
                        <input id="find-radio-2" type="radio" name="find_or_new" value="2" onchange="changeFindNew()">
                        <label for="find-radio-2">Новый клиент</label>
                    </div>
                </div>
                <div class="row if_find">
                    <div class="col-12 col-md-6">
                        <div class="floating-label-group js_find_group">
                            <input class="form-control js_find_keyup js_find_name" value="" maxlength="75" size="50" type="text" id="" autocomplete="off">
                            <label class="floating-label" for="">Поиск по ФИО</label>
                            <div class="js_find_result">

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="floating-label-group js_find_group">
                            <input class="form-control js_find_keyup js_find_phone js_mask_phone" value="" maxlength="75" type="text" id="" autocomplete="off">
                            <label class="floating-label" for="">Поиск по телефону</label>
                            <div class="js_find_result">
                                {{--@include('components.popup_select')--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row if_new" style="display: none">
                    <div class="col-12 col-md-6">
                        <div class="floating-label-group">
                            <input class="form-control sdfsdf" value="" maxlength="75" required="required" size="50" type="text" name="name" id="" autocomplete="off">
                            <label class="floating-label" for="">Имя Фамилия <abbr title="Обязательное поле">*</abbr></label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="floating-label-group">
                            <input class="form-control js_mask_phone" value="" type="tel" name="phone" id="" inputmode="text" autocomplete="off">
                            <label class="floating-label" for="">Телефон <abbr title="Обязательное поле">*</abbr></label>
                        </div>
                    </div>
                </div>
                <script>
                    $('.js_mask_phone').mask("+7(999) 999-9999");

                    function changeFindNew(){
                        let val = $('input[name="find_or_new"]:checked').val();
                        if(val == 1){
                            $('.if_find').show();
                            $('.if_new').hide();
                        } else if (val == 2){
                            $('.if_find').hide();
                            $('.if_new').show();
                        }
                    }

                    $('.js_find_keyup').on('keyup',function(I) {
                        //console.log($(this).val());
                        let parent = $(this).closest('.js_find_group');
                        switch(I.keyCode) {
                            case 13:
                            case 27:
                            case 38:
                            case 40:
                                break;
                            default:
                                let name = $('.js_find_name').val();
                                let phone = $('.js_find_phone').val();
                                $.ajax({
                                    type: 'GET',
                                    url: '{{route('clients.find')}}',
                                    data: {phone: phone, name:name},

                                    success:function(data){
                                        $('.js_find_result').html('')
                                        parent.find('.js_find_result').html(data);
                                        //$('.js_find_result');
                                        console.log(data);
                                    }
                                });
                                break;
                        }
                    });

                    $('.js_find_result').on('click', '.option', function() {
                        selectedUser($(this).data('user-id'));
                        $('.js_find_result').html('');
                    });

                    function selectedUser(id) {
                        $.post('{{route('orders.selectUser')}}', {order_id: {{$order->id}}, user_id: id, _token: '{!! csrf_token() !!}'}, function(data){
                            //console.log(data);
                            $('.js_user_replacement').replaceWith(data);
                        });
                    }
                </script>
            </div>
            @else
                @include('orders.components.user')
            @endif
            <div class="main_block">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="floating-label-group">
                            @php
                                $val_date = null;

                                if($order->date){
                                    $val_date = $order->date;
                                } elseif ($shift){
                                    $val_date = \Carbon\Carbon::createFromDate($shift->day->year, $shift->day->month, $shift->day->day, null)->format('Y-m-d');
                                }
                            @endphp


                            <input class="form-control" value="{{$val_date}}" min="{{date('Y-m-d')}}" required="required" size="50" type="date" name="date" id="change_date" onchange="changeForm()">
                            <label class="floating-label" for="">Дата <abbr title="Обязательное поле">*</abbr></label>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="floating-label-group">
                            <input class="form-control " value="{{$order->time_start}}" type="time" name="time" id="" inputmode="text" onchange="changeForm()">
                            <label class="floating-label" for="">Время <abbr title="Обязательное поле">*</abbr></label>
                        </div>
                    </div>
                    <script>
                        $('#change_date').change(function() {
                            $.get('{{route('shift.whoWorks')}}', {date: $(this).val()}, function(data){
                                console.log(data);
                                $('.js_times').hide();
                                $('.js_times_list').html();
                                $('.js_masters').show();
                                $('.js_masters_radio').html(data);
                            });
                        });
                    </script>
                </div>
                <style>
                    .order_input{border:1px solid #bbb;padding:10px;width:100%}
                </style>
                <div class="order_form_item js_masters" style="display: {{$users && count($users) > 0  ? 'block' : 'none'}}">
                    <label for="">Мастер</label>
                    <style>
                        .m_radio{display:inline-block;margin-right:4px}
                        .m_radio input[type=radio]{display:none}
                        .m_radio label{display:inline-block;cursor:pointer;padding:10px 15px;line-height:1.25;border:1px solid #bbb;border-radius:25px;user-select:none}
                        .m_radio input[type=radio]:checked + label{background:#2572fa;color:#fff;border:1px solid #2572fa}
                        .m_radio label:hover{color:#666}
                        .m_radio input[type=radio]:disabled + label{background:#efefef;color:#666}
                    </style>
                    <div class="js_masters_radio">
                        @include('modals.components.masters')
                    </div>
                </div>
                <style>
                    .orders_time{display: table;width: 100%}
                    .orders_time_title{font-weight: 600;}
                    .order_time{display: inline-block;
                        border: 1px solid #bbb;
                        font-size: 16px;
                        border-radius: 25px;
                        line-height: 1.25;
                        padding: 5px 10px;
                        margin-right: 6px;
                        margin-top: 6px;}
                </style>
                <div class="orders_time js_times" style="display: {{$times && count($times) > 0  ? 'block' : 'none'}}">
                    <label class="orders_time_title" for="">Записи</label>
                    <div class="js_times_list">
                        @include('orders.components.times')
                    </div>
                </div>
            </div>
            @include('orders.components.card')
            {{--@include('orders.components.goods')--}}
            <style>
                .group_textarea{width: 100%;
                    background: rgb(255, 255, 255);
                    padding: 15px;
                    border-radius: 4px;
                    border: 1px solid rgb(187, 187, 187);min-height: 125px;}
            </style>
<!--            <div class="main_block">
                <div class="group_title">Комментарий</div>
                <textarea class="group_textarea" name="descr" id="" >{!! $order->descr !!}</textarea>
            </div>-->
            <div class="main_block">
                <div class="order_form_item">
                    <button class="order_button" type="submit">{{$order->in_progress == 1 ? 'Добавить' : 'Обновить'}}</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function changeMaster(id){
            $('.js_shift_id').val(id);
            getMasterTime(id);
            changeForm();
        }

        function getMasterTime(id) {
            $.post('{{route('shift.times')}}', {shift_id: id, _token: '{!! csrf_token() !!}'}, function(data){
                console.log(data);
                $('.js_times').show();
                $('.js_times_list').html(data);

            });
        }

        function changeForm() {
            let data = $('#new_order').serialize();

            $.ajax({
                type: 'POST',
                url: '{{route('orders.preStore', $order->id)}}',
                data: $('#new_order').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                    console.log(data);
                }
            });
        }
    </script>
@endsection
