<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/png" href="/img/favicon.png" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->


    <script src="/js/jquery.min.js"></script>

<!--    <link rel="stylesheet" href="{{ asset('fontawesome-5/css/all.css') }}">-->
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    <script src="{{ asset('/js/mask.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<style>
    body {background: linear-gradient(90deg, #23a6d514, #e73c7e14, #ee775214);background-size: 400% 400%;animation: gradient 8s ease infinite;height: 100%;font-size: 16px;}

    @keyframes gradient {
        0% {background-position: 0% 50%;}
        50% {background-position: 100% 50%;}
        100% {background-position: 0% 50%;}
    }

    a{text-decoration: none;}

    .block{margin: 40px 0}
    .block_title{font-size: 32px;font-weight: 900;color: #222;line-height: 1.25;}
    .block_subtitle{margin-top: 6px;color: #222;width: 70%;font-size: 16px;line-height: 1.5;opacity: 0.6}
    .block_swiper{margin-top: 25px}
    .block_item{width: 250px;background: #fff;padding: 20px;border-radius: 12px;}
    .block_item.image{width: 300px;height: 300px}
    .tizers .block_item{width: 350px;}

    .block_item_image{width: 100%;height: 100%;border-radius: 8px;overflow: hidden;}
    .block_item_image img{width: 100%;height: 100%;object-fit: cover}


    .block_item_title{font-size: 16px;font-weight: 600;margin-bottom: 4px}
    .block_item_subtitle{font-size: 14px;color: #888}
    .block_item_dops{font-size: 14px;color: #888;margin-top: 10px}
    .block_item_price{font-size: 20px;font-weight: 900;margin-top: 8px;line-height: 1.25}
    .block_item_price span{font-size: 16px;font-weight: 500}
    .block_item_link{    padding: 10px 15px;
        background: #e73c7e;
        border-radius: 8px;
        margin-top: 10px;cursor: pointer;
        color: #fff;transition: all 0.3s;
        display: table;
        font-size: 13px;opacity: 0.25;
        font-weight: 600;}
    .block_item_link:hover{opacity: 1;}

    .x_page{display: flex;flex-direction: column;min-height: 100vh}
    .x_content{flex: 1}
</style>
<div class="x_page">
@widget('header')
<div class="x_content">
@yield('content')
</div>
@widget('footer')
</div>
<div class="app_modal"></div>
<style>
    @media(max-width:992px) {
        .banner_item_wrap{width:90%}
        .banner_item{padding-bottom:60%}
        .block_title{font-size:24px}
        .block_subtitle{margin-top:6px;color:#444;width:100%;font-size:14px;line-height:1.5;opacity:.6}
        .block_item_title{font-size:16px;margin-bottom:4px}
        .block_item_price{font-size:18px;font-weight:900;margin-top:8px;line-height:1.25}
        .block_item_dops{font-size:14px;color:#888;margin-top:6px}
        .block_item{padding:15px 20px;border-radius:12px}
        .tizers .block_item{width:275px}
        .block_item_subtitle{font-size:14px;color:#888}
        .block_item.image{width:250px;height:250px;padding:10px}
        .block_map{display:flex;gap:12px;margin-top:25px;flex-direction:column}
        .map_info{height:auto}
        .cabinet_container{margin: 20px auto;padding: 0 10px}
        .cabinet_title{font-size: 24px;line-height: 1.25;}
    }
    @media (max-width: 375px) {

    }
</style>
<script>
    @if (\Session::has('success'))
    alert("{!! Session::get('success') !!}");
    @endif

    $('.app_modal').on('click', '.js_modal_close, .modal_overlay', function(){
        $('.app_modal').html('');
    });
</script>
</body>
<script src="{{ asset('/js/swiper-bundle.min.js') }}"></script>
</html>
