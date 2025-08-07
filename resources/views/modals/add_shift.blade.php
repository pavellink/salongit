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
        <div class="modal_wrap center">
            <div class="modal_scroll" style="max-width:450px">
                <div class="modal_content">
                    <div class="modal_head" style="background: none;padding-bottom: 10px;">
                        <div id="modal_close" class="modal_close modal_close_btn"></div>
                        <div class="logo"><img src="/img/logo.jpg" alt=""></div>
                    </div>
                    <div class="modal_body">
                        <style>
                            .modal_form{text-align: center}
                            .modal_form_title{font-size: 22px;font-weight: 700;margin-bottom: 5px}
                            .modal_form_subtitle{font-size: 16px;
                                color: #666;
                                margin-bottom: 20px;line-height: 1.25;}
                            .modal_form_select{padding: 10px 15px;
                                border: 1px solid #bbb;min-width: 250px;
                                border-radius: 4px;margin-bottom: 20px}
                            .modal_form_btn{}
                            .modal_form_btn button{padding: 10px 30px;
                                background: #e73c7e;
                                color: #fff;
                                border-radius: 25px;}
                        </style>
                        <form action="{{route('shift.store')}}" class="modal_form" method="POST">
                            @csrf
                            <input type="hidden" name="day_id" value="{{$day_id}}">
                            <div class="modal_form_title">{{$day->day}} {{Helper::monthNum($day->month)}} {{$day->year}}</div>
                            <div class="modal_form_subtitle">Добавление мастера на смену</div>
                            <select class="modal_form_select" name="master_id" id="" required>
                                <option value="">Выберите из списка</option>
                                @forelse($users ?? [] as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @empty
                                @endforelse
                            </select>
                            <div class="modal_form_btn">
                                <button type="submit">Добавить</button>
                            </div>
                        </form>
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
