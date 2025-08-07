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
            .phone_input{    width: 150px;
                padding: 15px 20px;
                margin: 20px auto;
                display: block;
                border-radius: 8px;
                border: 1px solid #bbb;
                text-align: center;
                font-size: 26px;}
            .phone_input_confirm{padding: 15px 25px;
                text-align: center;
                font-weight: 600;
                color: #fff;
                border-radius: 8px;
                background: #e73c7e;}
            .phone_code_error{
                text-align: center;
                margin-top: 20px;
                color: #f00;
                font-weight: 900;}
        </style>
        <div class="modal_wrap center">
            <div class="modal_scroll" style="max-width:450px">
                <div class="modal_content">
                    <div class="modal_head" style="background: none;padding-bottom: 10px;">
                        <div id="modal_close" class="modal_close modal_close_btn js_modal_close"></div>
                        <div class="logo"><img src="/img/logo.jpg" alt=""></div>
                    </div>
                    <div class="modal_body">
                        <div class="phone_text">Звоним по номеру {{$phone}}, введите последние 4 цифры входящего номера</div>
                        <div class="phone_code_error" style="display: none">Неправльный код</div>
                        <input class="phone_input js_mask_code" type="text">

                        <div class="phone_input_confirm js_phone_confirm">Подтвердить телефон</div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('.js_mask_code').mask("9999");
            $('.js_phone_confirm').on('click', function (){
                let code = $('.js_mask_code').val();
                $('.phone_code_error').hide();
                $.post('{{route('verifi.phone.confirm')}}', {code: code, _token: '{!! csrf_token() !!}'}, function(data){
                    console.log(data);
                    if(data.message){
                        $('.phone_code_error').show();
                    } else {
                        $('.js_phone').prop('disabled', true);
                        $('.js_verifi').hide();
                        $('.js_confirm_phone').show();
                        $('.app_modal').html('');
                    }
                    //$('.app_modal').html(data);
                });
            });
        </script>
    </div>
</div>
