@extends('app_index')

@section('content')
    <style>
        body {
            background: linear-gradient(90deg, #23a6d514, #e73c7e14, #ee775214);
            background-size: 400% 400%;
            animation: gradient 8s ease infinite;
            height: 100%;font-size: 16px;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

    </style>

    <div class="container">
        <style>
            .banner_swiper{}
            .banner_item_wrap{width: 70%;max-width: 950px}
            .banner_item{padding-bottom: 50%;width:100%;position: relative;    border-radius: 12px;
                overflow: hidden;}
            .banner_item_image{position: absolute;width: 100%;height: 100%;top: 0;left: 0}
            .banner_item_image img{width: 100%;height: 100%;object-fit: cover}
        </style>
        <div class="banner" style="margin: 30px 0">
            <div class="swiper banner_swiper js_swiper_banner">
                <div class="swiper-wrapper">
                    <div class="swiper-slide banner_item_wrap">
                        <div class="banner_item">
                        <div class="banner_item_image">
                            <img src="https://i7.photo.2gis.com/images/branch/0/30258560066358973_bffc.jpg" alt="">
                        </div>
                        </div>
                    </div>
                    <div class="swiper-slide banner_item_wrap">
                        <div class="banner_item">
                        <div class="banner_item_image">
                            <img src="/img/s2.jpg" alt="">
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    let swiper = new Swiper(".js_swiper_banner", {
                        spaceBetween: 12,
                        slidesPerView: 'auto',
                    });
                });
            </script>
        </div>
    </div>
    <style>
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
        .block_item_subtitle{font-size: 13px;color: #888}
        .block_item_dops{font-size: 13px;color: #888;margin-top: 10px}
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
    </style>
    <div class="container">
        @widget('services')
        @widget('tizers')
        @widget('gallery')
        @widget('map')
    </div>


@endsection
