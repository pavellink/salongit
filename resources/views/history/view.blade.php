@extends('app')
@section('content')
    @widget('aside', ['page' => 2])

    <script type="text/javascript" src="{{ asset('js/swiper.min.js') }}"></script>
    <div class="page_content">
        <div class="main_block" style="display: flex;align-items: center">
            <h1 class="page_title">История клиента: {{$user->name}}</h1>
        </div>
        <style>
            .history{}
            .history_item{}
            .history_item_header{display: flex;justify-content: space-between;}
            .history_item_info{width: 50%;}
            .history_item_title{font-weight: 600;text-transform: capitalize;}
            .history_item_descr{margin-top: 12px;font-size: 16px;line-height: 1.25;}
            .history_item_price{}
            .history_item_price span{font-weight: 600}
            .history_item_data{}

            .history_item_body{    margin-top: 25px;position: relative}
            .image{width: 175px;margin-right: 15px;border-radius: 8px;overflow: hidden}

            .s_arrow{display: flex;
                width: 40px;
                height: 40px;
                background: #2572fa;
                justify-content: center;
                align-items: center;
                color: #fff;
                border-radius: 8px;
                font-size: 18px;}
            .s_arrow.swiper-button-disabled {
                background: #bad3fd;
            }
            .swiper_wrap{position: relative}
            .arrow_left{position: absolute;
                top: 50%;
                z-index: 10;
                margin-top: -20px;
                left: -10px;}
            .arrow_right{position: absolute;
                top: 50%;
                z-index: 10;
                margin-top: -20px;
                right: -10px;}

            .open_order{  background: #acd0ff;
                color: #fff;
                padding: 5px 10px;
                font-size: 14px;
                cursor: pointer;
                font-weight: 400;
                border-radius: 50px;
                display: table;
                margin-top: 12px;}
            .open_order:hover{background: #2572fa;
                color: #fff;}
        </style>
        <div class="history">
        @forelse($orders ?? [] as $order)
        <div class="main_block">
            <div class="history_item">
                <div class="history_item_header">
                    <div class="history_item_info">
                        <div class="history_item_title">{{$order->title ?? 'Без названия'}}</div>
                        <div class="open_order" onclick="viewOrder({{$order->id}})">Детали записи</div>
                    </div>
                    <div class="history_item_price">
                        <span>{{$order->total ?? 'Ошибка'}}</span> ₽ / <span>{{$order->mins}}</span> мин.
                    </div>
                    <div class="history_item_data">
                        {{Helper::datetime($order->created_at)}}
                    </div>
                </div>
                @if($order->images && count($order->images) > 0)
                <div class="history_item_body">
                    <div class="swiper_wrap">
                        <div class="swiper mySwiper{{$order->id}}">
                            <div class="images swiper-wrapper">
                                @forelse([1,2,3,3,4,4,4,4,4] ?? [] as $order2)
                                <div class="swiper-slide image">
                                    <div class="b_image_box b_img_4_3">
                                        <div class="b_image">
                                            <img src="https://www.boradmin.ru/tinybrowser/images/novosty.novosty/2019/1_-1.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                                @empty
                                @endforelse
                            </div>

                        </div>
                        <div class="swiper_arrow">
                            <div class="s_arrow arrow_left js_left{{$order->id}}"><i class="fad fa-arrow-alt-left"></i></div>
                            <div class="s_arrow arrow_right js_right{{$order->id}}"><i class="fad fa-arrow-alt-right"></i></div>
                        </div>
                        <script>
                            var swiper = new Swiper(".mySwiper{{$order->id}}", {
                                slidesPerView: 'auto',
                                navigation: {
                                    nextEl: ".js_right{{$order->id}}",
                                    prevEl: ".js_left{{$order->id}}",
                                },
                            });
                        </script>
                    </div>
                </div>
                @endif
            </div>
        </div>

        @empty
        @endforelse
        </div>
    </div>

@endsection
