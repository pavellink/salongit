@extends('app')
@section('content')
    @widget('aside', ['page' => 4])
    <div class="page_content" style="background: #fff">
        <div class="main_block">
            <h1 class="page_title">Календарь</h1>
        </div>

        <style>
            .calendar{display:grid;width:100%;overflow:auto;
               grid-template-columns: 115px;grid-column-gap: 1px;
                grid-row-gap: 1px;
                background-color: #ddd;
                grid-auto-flow: row dense;
            }
            .calendar-container{background:#fff;border-radius: 20px}
            .calendar-header{padding:20px 30px;border-bottom:1px solid #ddd}
            .calendar-header h1{margin:0;font-size:18px}
            .filter_month{font-weight: 700}
            .calendar-header p{margin:5px 0 0;font-size:13px;font-weight:600;color:#222}
            .calendar-header button{background:0;border:0;padding:0;color:rgba(81,86,93,0.7);cursor:pointer;outline:0}

        </style>
        <div class="calendar-container">
            <div class="calendar-header ">
                <form action="" class="filter">
                    <select class="filter_month" name="month" id="">
                        <option value="1" {{Helper::month(request()->query('month')) == 1 ? 'selected' : null}}>Январь</option>
                        <option value="2" {{Helper::month(request()->query('month')) == 2 ? 'selected' : null}}>Февраль</option>
                        <option value="3" {{Helper::month(request()->query('month')) == 3 ? 'selected' : null}}>Март</option>
                        <option value="4" {{Helper::month(request()->query('month')) == 4 ? 'selected' : null}}>Апрель</option>
                        <option value="5" {{Helper::month(request()->query('month')) == 5 ? 'selected' : null}}>Май</option>
                        <option value="6" {{Helper::month(request()->query('month')) == 6 ? 'selected' : null}}>Июнь</option>
                        <option value="7" {{Helper::month(request()->query('month')) == 7 ? 'selected' : null}}>Июль</option>
                        <option value="8" {{Helper::month(request()->query('month')) == 8 ? 'selected' : null}}>Август</option>
                        <option value="9" {{Helper::month(request()->query('month')) == 9 ? 'selected' : null}}>Сентябрь</option>
                        <option value="10" {{Helper::month(request()->query('month')) == 10 ? 'selected' : null}}>Октябрь</option>
                        <option value="11" {{Helper::month(request()->query('month')) == 11 ? 'selected' : null}}>Ноябрь</option>
                        <option value="12" {{Helper::month(request()->query('month')) == 12 ? 'selected' : null}}>Декабрь</option>
                    </select>
                    <select class="filter_month" name="year" id="">
                        <option value="2022" {{request()->query('year') == 2022 ? 'selected' : null}}>2022</option>
                        <option value="2023" {{request()->query('year') == 2023 ? 'selected' : null}}>2023</option>
                        <option value="2024" {{request()->query('year') == 2024 || !request()->query('year') ? 'selected' : null }}>2024</option>
                    </select>
<!--                    <span style="margin-left: 20px;color: #888">{{request()->query('year')}}</span>-->
                </form>
            </div>
            <script>
                $('.filter select').on('change', function () {
                    $('.filter').submit();
                });
            </script>
            <style>
                .swiper{width:100%;height:100%}
                .swiper-slide{text-align:center;font-size:18px;background:#fff;display:-webkit-box;display:-ms-flexbox;display:-webkit-flex;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;-webkit-justify-content:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;-webkit-align-items:center;align-items:center}
                .slicks{padding:15px 60px;border-bottom:1px solid #ddd;position:relative}
                .slick{width:auto!important;display:block;padding:12px 16px;border:1px solid #ddd;border-radius:12px;margin-right:6px;font-size:16px}
                .active{background:#2572fa;color:#fff;border:1px solid #2572fa}
                .active .slick_dow{color:#fff}
                .slick_title{font-weight:600;font-size:15px;color: #444}
                .active .slick_title{color: #fff}
                .slick_dow{font-size:14px;color:#888}
                .swiper-button-next2{position:absolute;right:15px;top:50%;display:flex;width:30px;height:30px;align-items:center;justify-content:center;z-index:2;margin-top:-15px;background:#fff;border:1px solid #ddd;border-radius:50%}
                .swiper-button-prev2{position:absolute;left:15px;top:50%;display:flex;width:30px;height:30px;align-items:center;justify-content:center;z-index:2;margin-top:-15px;background:#fff;border:1px solid #ddd;border-radius:50%}
            </style>
            <div class="slicks">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper" style="display:flex;">
                        @forelse($days ?? [] as $day)
                            <a href="{{route('days', ['day' => $day->day, 'month' => request()->query('month'), 'year' => request()->query('year')])}}" class="swiper-slide slick {{$dayOfMonth == $day->day ? 'active' : null}}">
                                <div class="slick_title">{{$day->day}}</div>
                                <div class="slick_dow">{{Helper::dayOfWeek($day->day_of_week)}}</div>
                            </a>
                        @empty
                        @endforelse
                    </div>
                </div>
                <div class="swiper-button-next2"><i class="fas fa-angle-right"></i></div>
                <div class="swiper-button-prev2"><i class="fas fa-angle-left"></i></div>

                <script>
                    $(document).ready(function() {
                        var swiper = new Swiper(".mySwiper", {
                           //loop: true,
                            slidesPerView: 'auto',
                            //centeredSlides: true,
                            navigation: {
                                nextEl: ".swiper-button-next2",
                                prevEl: ".swiper-button-prev2",
                            },
                        });
                        swiper.slideToLoop({{$dayOfMonth - 1}});
                    });
                </script>
            </div>
            <style>
                .day{min-height: 40px;box-sizing: border-box;position: relative;background: #fff;display: flex;padding: 0 12px;align-items: center;z-index: 1;}
                .day .add_hover{display: none;font-size: 14px;color: #888}
                .day:hover .add_hover{display: block}
                .master{display: flex;align-items: center;font-size: 16px;justify-content: center;font-weight: 600;}
                .master .remove{display: none;
                    margin-left: 10px;
                    font-size: 14px;background: none;
                    font-weight: 400;
                    color: #666;}
                .master:hover .remove{display: inherit}
                .column-1{grid-column:1;padding:0 30px;display:flex;justify-content:center;align-items:center;width:115px;font-size:15px;color:#222;font-weight:600}
                .column-2{grid-column:2}
                .column-3{grid-column:3}
                .column-4{grid-column:4}
                .column-5{grid-column:5}
                .column-6{grid-column:6}
                .column-7{grid-column:7}
                .column-8{grid-column:8}

                .task{background:#E0F0FF;color:#444;font-size:16px;margin:12px;position:relative;border-radius:8px;padding:15px 20px 15px 25px;z-index:1}
                .task_price{
                    font-size: 15px;
                    color: #444;
                    font-weight: 600;}
                .task-1{position:absolute;top:0px;bottom:0px;width:4px;border-radius:25px;left:0px;
                    background: rgba(37,114,250, 0.65);}
                .checkbox{position:absolute;right:20px;top:15px}
                .checkbox input[type="checkbox"]{display:none}
                .checkbox label:before{background:#fff;display:flex;width:20px;color:#fff;content:"\f00c";font-family:"Font Awesome 5 Free";font-weight:600;font-size:11px;height:20px;align-items:center;justify-content:center;border-radius:50%}
                .checkbox input:checked + label:before{background:#2572FA}

                .task_info{  }
                .task_descr{font-size: 14px;
                    -webkit-line-clamp: 2;
                    color: #666;
                    display: -webkit-box;
                    line-height: 1;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    margin-bottom: 12px;}
                .task_edit{    margin-left: 8px;
                    font-size: 17px;
                    position: absolute;display: none;
                    right: 50px;
                    top: 15px;}
                .task:hover .task_edit{display: block}
                .info_head{}
                .info_footer{    font-size: 16px;
                    color: #444;
                    margin-top: 10px;}
                .task_delete{position: absolute;
                    right: 15px;display: none;opacity: 0.25;
                    bottom: 15px;}
                .task_delete:hover{opacity: 1;}
                .task_delete button{color: #0d6efd}
                .task:hover .task_delete{display: block}

                .open_order{  background: #fff;
                    color: #444;
                    padding: 5px 10px;
                    font-size: 14px;
                    cursor: pointer;
                    font-weight: 400;
                    border-radius: 50px;
                    display: table;
                    margin-top: 12px;}
                .open_order:hover{background: #2572fa;
                    color: #fff;}

                .day_history{margin-left: 8px;
                    color: #acd0ff;}
                .day_history:hover{color: #2572fa}
            </style>


            <div class="calendar">
                <div class="day column-1" style="grid-row: 1;"></div>
                @forelse($times ?? [] as $time => $value)
                    <div class="day column-1" style="grid-row: {{$time + 2}};">{{$value}}</div>
                @empty
                @endforelse
                @forelse($shifts ?? [] as $shift)
                    <div class="day column-{{$loop->iteration + 1}} master" style="grid-row: 1;"><span>{{$shift->user->name}}</span>
                            <form action="{{route('shift.delete')}}" class="add_form" method="POST">
                                @csrf
                                <input type="hidden" name="shift_id" value="{{$shift->id}}">
                                <input type="hidden" name="master_id" value="{{$shift->master_id}}">
                                <button type="submit" class="remove">Удалить мастера</button>
                            </form>


                        </div>
                    @forelse($times ?? [] as $time => $value)
                        <div class="day column-{{$loop->parent->iteration + 1}}" style="grid-row: {{$time + 2}};">
                            <a href="{{route('orders.add', ['shift_id' => $shift->id, 'master_id' => $shift->master_id, 'day_id' => $shift->day_id, 'time_start' => $value])}}" class="add_hover">+ Добавить запись</a>
                        </div>
                    @empty
                    @endforelse
                    @forelse($shift->orders ?? [] as $order)


                        <section class="task {{Helper::color($order)}}" style="grid-column: {{$loop->parent->iteration + 1}};grid-row: {{Helper::rowTime($order->time_start)}}{{'/'}}{{Helper::rowTime($order->time_finish)}};" onclick="viewOrder({{$order->id}})">
                            <div class="task-1 {{Helper::colorBorder($order)}}"></div>
                            <div class="task_info">
                                <div class="task_time">{{Helper::time($order->time_start)}} - {{Helper::time($order->time_finish)}}</div>
                                <div class="task_title">{{$order->title}}</div>
                                <div class="task_user">
                                    @if($order->user_id)
                                    <span>{{$order->user_name}}</span>
                                        <span class="btn_show_phone">{{Helper::phone($order->user_phone)}}</span>
                                    @else
                                        <a href="{{route('orders.create', $order->id)}}" target="_blank">Указать пользователя</a>
                                    @endif


                                </div>
                            </div>
                        </section>
                    @empty
                    @endforelse
                @empty
                    <div class="day column-2 master" style="grid-row: 1;"></div>
                    @forelse($times ?? [] as $time => $value)
                        <div class="day column-2" style="grid-row: {{$time + 2}};">
                        </div>
                    @empty
                    @endforelse
                @endforelse


                    <style>
                        .task_title{font-weight:600;margin-bottom:8px;font-size:17px}
                        .task_time{font-size:15px;color:#888;margin-bottom: 8px}
                    </style>
                </div>
            </div>
        </div>
@endsection
