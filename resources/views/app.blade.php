<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <meta name="viewport" content="min-width=1140px">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Орхидея</title>

    <script src="/js/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/admin.css">
<!--    <link rel="stylesheet" href="{{ asset('fontawesome-5/css/all.css') }}">-->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('/js/mask.js') }}"></script>
    <script src="{{ asset('/ckeditor5/build/ckeditor.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>
    body{background: #e0f0ff;}
    * {
        margin: 0;
        padding: 0;
        border: 0
    }

    *, :after, :before {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        line-height: 1.25;
    }

    :active, :focus {
        outline: none
    }

    a:active, a:focus {
        outline: none
    }

    aside, footer, header, nav {
        display: block
    }

    button, input, textarea {
        font-family: inherit
    }

    input::-ms-clear {
        display: none
    }
    ul, li, p {
        display: block;
        padding: 0;
        margin: 0;
    }

    button {
        cursor: pointer
    }

    button::-moz-focus-inner {
        padding: 0;
        border: 0
    }

    a, a:visited {
        text-decoration: none
    }

    a:hover {
        text-decoration: none
    }

    ul li {
        list-style: none
    }

    img {
        vertical-align: top;
        display: block;
        max-width: 100%;
        max-height: 100%;
        -o-object-fit: cover;
        object-fit: cover
    }

    iframe {
        width: 100%
    }

    ::-webkit-scrollbar{width:4px;border-radius:30px;height:2px}
    ::-webkit-scrollbar-thumb{background-color:#e0f0ff;outline:1px solid #F3F1F1;border-radius:30px}
    ::-webkit-scrollbar-track{box-shadow:inset 0 0 2px #000;border-radius:30px}

    .b_image_box{position:relative;width:100%;height:0}
    .b_image_box .b_image{position:absolute;top:0;width:100%;height:100%;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:stretch;-ms-flex-align:stretch;align-items:stretch;margin:0;padding:0;list-style-type:none;/*background-color:rgba(0,0,0,.04)*/;z-index:0}
    .b_image_box .b_image img{position:relative;top:50%;left:50%;height:100%;width:100%;-o-object-fit:cover;object-fit:cover;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);border:0;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}
    .b_img_34_9{padding-bottom: 25%;}
    .b_img_27_9{padding-bottom: 33%;}
    .b_img_22_9{padding-bottom: 40%;}
    .b_img_18_9{padding-bottom: 50%;}
    .b_img_16_9{padding-bottom: 56%;}
    .b_img_4_3{padding-bottom: 75%;}
    .b_img_3_2{padding-bottom: 66%;}
    .b_img_1_1{padding-bottom: 100%;}
    .b_img_2_3{padding-bottom: 150%;}
    .b_img_3_4{padding-bottom: 133%;}
    .b_img_9_16{padding-bottom: 177%;}

    .status_work{background: #E0F0FF!important;}
    .status_finish{background: #daffd2!important;;}
    .status_close{background: #ffe0e0!important;;}

    .border_work{background: rgba(37,114,250, 0.65)!important;;}
    .border_finish{background: rgba(89,183,25, 0.65)!important;;}
    .border_close{background: rgba(250,37,37, 0.65)!important;;}
</style>
<body oncopy="return false;">
<style>
    .app_container{margin:30px 0;}
    .flex_cabinet{display: flex}
    .page_title{font-size: 26px;font-weight: 700;margin-bottom: 0;}
    .page_cabinet{padding: 30px}
    .page_content{width: 100%}
    .title_block{padding: 25px 30px;
        background: #fff;
        margin-bottom: 20px;
        border-radius: 20px;}
    .page_content{background: #fff;border-radius: 20px;overflow: hidden}
    .main_block{border-bottom: 3px solid #e0f0ff;padding: 30px 40px;word-break: break-word;}
    .main_block.with_tab{padding-bottom: 0}
    .form-control{border-radius:10px;border:solid 1px #bbb;width:100%;height:65px;padding:30px 20px 10px;background:#fff}
    .floating-label-group{position:relative;margin-bottom:20px}
    .floating-label-group .floating-label{top:10px;left:20px;font-size:13px;opacity:1;color:#888;position:absolute;pointer-events:none}

    .order_button{border-radius:10px;background-color:#2572fa;display:-webkit-box;display:flex;-webkit-box-align:center;align-items:center;color:#fff;-webkit-box-pack:center;justify-content:center;height:58px;border:none;width:250px}
    .order_button:hover{background-color: #0b5ed7;border-color: #0a58ca;}
    .order_form_item{margin-bottom:15px}
    .order_form_item:last-child{margin-bottom:0}
    .order_form_item label{font-weight:600;margin-bottom:4px}
</style>
<div class="app_container">
    <div class="container">
        <div class="flex_cabinet">
            @yield('content')
        </div>
    </div>
</div>
<div class="app_modal"></div>
<script>
    @if (\Session::has('success'))
    alert("{!! Session::get('success') !!}");
    @endif

    function changeCompleted(id) {
        console.log($(this).val());
    }
    $('body').on('change', '.js_is_completed', function() {
        let checked = $(this).is(':checked');
        let val = $(this).val();
        $.post('{{route('orders.completed')}}', {checked: checked, order_id: val, _token: '{!! csrf_token() !!}'}, function(data){
            console.log(data);
        });
    });

    function getContact(id) {
        $.post('{{route('modal.phone')}}', {user_id: id, _token: '{!! csrf_token() !!}'}, function(data){
            $('.app_modal').html(data);
        });
    }
    function addShift(id) {

        console.log(id);
        $.get('{{route('modal.shift.add')}}', {day_id: id}, function(data){
            $('.app_modal').html(data);
        });
    }

    function viewShift(id) {
        $.get('{{route('modal.shift.view')}}', {shift_id: id}, function(data){
            $('.app_modal').html(data);
        });
    }

    function viewOrder(id) {
        $.get('{{route('modal.order.view')}}', {order_id: id}, function(data){
            $('.app_modal').html(data);
        });
    }
</script>
<script src="{{ asset('/js/swiper-bundle.min.js') }}"></script>
</body>
</html>
