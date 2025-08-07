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
            .modal_head{width:100%;padding:20px;background:#f7f8f9;position:relative}
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
            <div class="modal_scroll" style="max-width:650px">
                <div class="modal_content">
                    <div class="modal_head">
                        <div id="modal_close" class="modal_close modal_close_btn"></div>
                        <div class="title">Добавление нового заказа</div>
                    </div>
                    <div class="modal_body">
                        <div class="new_orders">
                            <div class="modal_form_item">
                                <label for="">Имя</label>
                                <div class="">
                                    <input type="text" class="modal_input">
                                </div>
                            </div>
                            <div class="modal_form_item">
                                <label for="">Телефон</label>
                                <div class="">
                                    <input type="text" class="modal_input">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal_head">
                        <div class="title">Услуга</div>
                    </div>

                    <input type="hidden" name="shift_id" value="{{request()->query('shift_id')}}">
                    <input type="hidden" name="master_id" value="{{request()->query('master_id')}}">
                    <style>
                        .modal_input{border: 1px solid #bbb;
                            padding: 10px;
                            width: 100%;}
                        .modal_select{border: 1px solid #bbb;
                            padding: 12px 10px;
                            width: 100%;}
                        .modal_button{width: 100%;
                            margin-top: 15px;
                            background: #fff;
                            border: 1px dashed #2572fa;
                            padding: 12px;
                            color: #2572fa;
                            font-weight: 600;
                            border-radius: 8px;}
                        .modal_button:hover{background: #2572fa;color: #fff}
                        .modal_form_item{margin-bottom: 15px}
                        .modal_form_item:last-child{margin-bottom: 0}
                        .modal_form_item label{font-weight: 600;margin-bottom: 4px}
                    </style>
                    <div class="modal_body">
                        <div class="new_orders">
                            <div class="modal_form_item">
                                <label for="">Выберите услугу</label>
                                <div class="">
                                    <select name="" id="" class="modal_select">
                                        <option value="">Выберите из списка</option>
                                        <option value="">Окрашивание</option>
                                        <option value="">Стрижка</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal_form_item">
                                <label for="">Дата</label>
                                <div class="">

                                    <input type="date" class="modal_input" value="{{$shift ? \Carbon\Carbon::createFromDate($shift->day->year, $shift->day->month, $shift->day->day, null)->format('Y-m-d') : null}}" min="{{date('Y-m-d')}}" id="change_date">
                                </div>
                            </div>
                            <script>
                                $('#change_date').change(function() {
                                    $.get('{{route('shift.whoWorks')}}', {date: $(this).val()}, function(data){
                                        console.log(data);
                                        $('.js_masters').show();
                                        $('.js_masters_radio').html(data);
                                    });
                                });
                            </script>
                            <div class="modal_form_item js_masters" style="display: {{$users && count($users) > 0 ? 'block' : 'none'}}">
                                <label for="">Мастер</label>
                                <style>
                                    .m_radio{display:inline-block;margin-right:4px}
                                    .m_radio input[type=radio]{display:none}
                                    .m_radio label{display: inline-block;
                                        cursor: pointer;
                                        padding: 10px 15px;line-height: 1.25;
                                        border: 1px solid #bbb;
                                        border-radius: 25px;
                                        user-select: none;}
                                    .m_radio input[type=radio]:checked + label{background:#2572fa;color: #fff;border: 1px solid #2572fa;}
                                    .m_radio label:hover{color:#666}
                                    .m_radio input[type=radio]:disabled + label{background:#efefef;color:#666}
                                </style>
                                <div class="js_masters_radio">
                                    @include('modals.components.masters')
                                </div>
                            </div>
                            <div class="modal_form_item">
                                <label for="">Время</label>
                                <div class="">
                                    <input type="time" class="modal_input" min="08:00" step="900">
                                </div>
                            </div>
                            <div class="modal_form_item">
                                <label for="">Цена</label>
                                <div class="">
                                    <input type="number" class="modal_input">
                                </div>
                            </div>
                            <div class="modal_form_item">
                                <button class="modal_button" type="submit">Добавить</button>
                            </div>
                        </div>
                    </div>
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
