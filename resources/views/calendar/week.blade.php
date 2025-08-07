@extends('app')
@section('content')
    @widget('aside', ['page' => 1])
    <div class="page_content" style="background: #fff">
        <div class="main_block">
            <h1 class="page_title">По неделям ({{$year}})</h1>
        </div>

        <style>
            .calendar{display:grid;width:100%;overflow:auto;
               grid-column-gap: 1px;
                grid-row-gap: 1px;
                background-color: #ddd;grid-template-columns: min-content repeat(7, 1fr);
                grid-auto-flow: row dense;
            }
            .calendar-container{background:#fff;border-radius: 20px}
            .calendar-header{padding:20px 30px;border-bottom:1px solid #ddd}
            .calendar-header h1{margin:0;font-size:18px}
            .filter_month{font-weight: 700}
            .calendar-header p{margin:5px 0 0;font-size:13px;font-weight:600;color:#222}
            .calendar-header button{background:0;border:0;padding:0;color:rgba(81,86,93,0.7);cursor:pointer;outline:0}

        </style>

        <style>
            .calendar_masters{    display: flex;
                flex-wrap: wrap;
                gap: 20px;
                align-items: center;
                padding: 25px 40px;
                border-bottom: 1px solid #ddd;}
            .calendar_masters_title{}
            .calendar_master{    padding: 10px 15px;
                border: 1px solid #ddd;
                border-radius: 6px;font-size: 15px;}
            .calendar_master.active{background: #2572FA;color: #fff}
        </style>
        <div class="calendar-container">
            <div class="calendar_masters">
                <div class="calendar_masters_title">Мастер:</div>
                @forelse($users ?? [] as $user)
                <a href="{{route('week', ['date' => $week, 'master_id' => $user->id])}}" class="calendar_master {{$user->id == request()->query('master_id') ? 'active' : null}}">{{$user->name}}</a>
                @empty
                @endforelse
            </div>


            <style>
                .day{min-height: 40px;box-sizing: border-box;position: relative;background: #fff;display: flex;padding: 0 12px;align-items: center;z-index: 1;}
                .day.first_row{padding-top: 15px;padding-bottom: 15px}
                .day_week_title{    text-align: center;
                    font-weight: 400;
                    font-size: 14px;margin-bottom: 4px;
                    color: #666;}
                .day_week_month{text-align: center;
                    font-size: 15px;
                    }
                .week_tab:hover{background: #2572FA;color: #fff}
                .day--disabled{color:#222;background-color:rgb(0 0 0 / 10%);background-image:url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23f9f9fa' fill-opacity='1' fill-rule='evenodd'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/svg%3E");height: 100%;    position: absolute;
                    width: 100%;
                    top: 0;
                    left: 0;}

                .day .add_hover{display: none;font-size: 14px;color: #888}
                .day:hover .add_hover{display: block}
                .master{display: flex;align-items: center;font-size: 16px;justify-content: center;font-weight: 600;}



                .master .remove{display: none;
                    margin-left: 10px;
                    font-size: 14px;background: none;
                    font-weight: 400;
                    color: #666;}
                .master:hover .remove{display: inherit}
                .column-1{grid-column:1;padding:0 15px;display:flex;justify-content:center;align-items:center;font-size:15px;color:#222;font-weight:500}
                .column-9{grid-column:9;padding:0 15px;display:flex;justify-content:center;align-items:center;font-size:15px;color:#222;font-weight:500}


                .task{background:#E0F0FF;color:#444;font-size:16px;margin:12px;position:relative;border-radius:8px;padding:10px 10px 10px 15px;z-index:1;max-width: 200px;    display: flex;
                    flex-direction: column;gap: 20px;cursor: pointer}
                .task_footer{display: flex;justify-content: space-between;align-items: end}
                .task_footer_left{display: flex;flex-wrap: wrap;gap: 15px;    align-items: center;}
                .task_footer_right{display: flex;flex-wrap: wrap;gap: 15px}
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

                .task_info{    flex: 1;
                    display: flex;
                    flex-direction: column;
                    gap: 8px;}

                .task_edit{font-size: 16px;    display: none;}
                .task:hover .task_edit{display: block}

                .info_footer{    font-size: 16px;color: #444;margin-top: 10px;}
                .task_delete{display: none;opacity: 0.25;}
                .task_delete:hover{opacity: 1;}
                .task_delete button{color: #0d6efd}
                .task:hover .task_delete{display: block}

                .open_order{  background: #fff;color: #444;padding: 5px 10px;font-size: 14px;cursor: pointer;font-weight: 400;border-radius: 50px;display: table;}
                .open_order:hover{background: #2572fa;color: #fff;}

                .day_history{margin-left: 8px;color: #acd0ff;}
                .day_history:hover{color: #2572fa}

                .task_title{font-weight:600;font-size:15px;
                    -webkit-box-orient: vertical;
                    -webkit-line-clamp: 2;
                    display: -webkit-box;
                    overflow: hidden;
                    text-overflow: ellipsis;}
                .tast_price{}
                .task_time{font-size:14px;color:#999;}
            </style>


            <div class="">
                <div class="">

            <div class="calendar ">
                <a href="{{route('week', ['date' => $prevWeek, 'master_id' => request()->query('master_id')])}}" class="day first_row week_tab column-1" style="grid-row: 1;"><i class="fas fa-angle-left"></i></a>
                @forelse($times ?? [] as $time => $value)
                    <div class="day first_row column-1" style="grid-row: {{$time + 2}};">{{$value}}</div>
                @empty
                @endforelse
                <a href="{{route('week', ['date' => $nextWeek, 'master_id' => request()->query('master_id')])}}" class="day week_tab column-9" style="grid-row: 1;"><i class="fas fa-angle-right"></i></a>
                @forelse($times ?? [] as $time => $value)
                    <div class="day column-9" style="grid-row: {{$time + 2}};">{{$value}}</div>
                @empty
                @endforelse
                @forelse($days ?? [] as $day)
                <div class="day first_row column-{{$loop->iteration + 1}} master" style="grid-row: 1;grid-column:{{$loop->iteration + 1}}">
                    <div class="">
                        <div class="day_week_title">{{Helper::dayOfWeek($day->day_of_week)}}</div>
                    <div class="day_week_month">{{$day->day}} {{Helper::monNum($day->month)}}</div>
                    </div>
                </div>
                @forelse($day->shifts ?? [] as $shift)
                    @forelse($times ?? [] as $time => $value)
                        <div class="day column-{{$loop->parent->parent->iteration + 1}}" style="grid-row: {{$time + 2}};grid-column:{{$loop->parent->parent->iteration + 1}}">
                            <a href="{{route('orders.add', ['shift_id' => $shift->id, 'master_id' => $shift->master_id, 'day_id' => $shift->day_id, 'time_start' => $value])}}" class="add_hover">+ Добавить запись</a>
                        </div>
                    @empty
                    @endforelse
                    @forelse($shift->orders ?? [] as $order)
                        @include('calendar.task')
                    @empty
                    @endforelse
                @empty
                    @forelse($times ?? [] as $time => $value)
                        <div class="day column-2" style="grid-row: {{$time + 2}};">
                            <div class="day--disabled"></div>
                        </div>
                    @empty
                    @endforelse
                @endforelse
                @empty
                @endforelse
            </div>

                </div>
            </div>

            <script>
                $(document).ready(function() {

                    let galleryTop = new Swiper('.js_days_swiper', {
                        slidesPerView: 'auto',
                        initialSlide: 7,
                        centeredSlides: true,
                        slideToClickedSlide: true,
                        /*thumbs: {
                            swiper: galleryThumbs
                        },*/
                        navigation: {
                            nextEl: '.swiper-button-next2',
                            prevEl: '.swiper-button-prev2',
                        },

                    });
                    let galleryThumbs = new Swiper('.js_days_thumbs', {
                        slidesPerView: 'auto',
                        slideToClickedSlide: false,
                        allowTouchMove: false,
                    });
                    galleryTop.controller.control = galleryThumbs;
                });
                //galleryTop.slideToLoop(6);
            </script>
        </div>
    </div>
@endsection
