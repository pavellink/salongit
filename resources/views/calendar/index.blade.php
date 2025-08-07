@extends('app')
@section('content')
@widget('aside', ['page' => 1])
<div class="page_content" style="background: #fff">
    <div class="main_block">
        <h1 class="page_title">Календарь</h1>
    </div>

    {{--@include('modals.view_shift')--}}

    <style>
        html,
        body {
            width: 100%;
            height: 100%;
        }

        .calendar{display:grid;width:100%;grid-template-columns:repeat(7,minmax(120px,1fr));grid-template-rows:50px;grid-auto-rows:135px;overflow:auto}
        .calendar-container{background:#fff;border-radius: 20px}
        .calendar-header{padding:20px 30px;border-bottom:1px solid #ddd}
        .calendar-header h1{margin:0;font-size:18px}
        .filter_month{font-weight: 700}
        .calendar-header p{margin:5px 0 0;font-size:13px;font-weight:600;color:#222}
        .calendar-header button{background:0;border:0;padding:0;color:rgba(81,86,93,0.7);cursor:pointer;outline:0}
        .day_wrap{border-bottom:1px solid #ddd;border-right:1px solid #ddd;position:relative;z-index:1}
        .day_wrap:nth-of-type(7n + 7){border-right:0}
        .day_wrap:nth-of-type(n + 1):nth-of-type(-n + 7){grid-row:2}
        .day_wrap:nth-of-type(n + 8):nth-of-type(-n + 14){grid-row:3}
        .day_wrap:nth-of-type(n + 15):nth-of-type(-n + 21){grid-row:4}
        .day_wrap:nth-of-type(n + 22):nth-of-type(-n + 28){grid-row:5}
        .day_wrap:nth-of-type(n + 29):nth-of-type(-n + 35){grid-row:6}
        .day_wrap:nth-of-type(7n + 1){grid-column:1/1}
        .day_wrap:nth-of-type(7n + 2){grid-column:2/2}
        .day_wrap:nth-of-type(7n + 3){grid-column:3/3}
        .day_wrap:nth-of-type(7n + 4){grid-column:4/4}
        .day_wrap:nth-of-type(7n + 5){grid-column:5/5}
        .day_wrap:nth-of-type(7n + 6){grid-column:6/6}
        .day_wrap:nth-of-type(7n + 7){grid-column:7/7}

        .day{text-align:right;padding:15px 20px;font-size:16px;box-sizing:border-box;color:#222;}

        .day-name{font-size:12px;text-transform:uppercase;color:#222;text-align:center;border-bottom:1px solid #ddd;line-height:50px;font-weight:500}
        .day--disabled{color:#222;/*background-color:rgb(0 0 0 / 10%);*/background-image:url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23f9f9fa' fill-opacity='1' fill-rule='evenodd'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/svg%3E");height: 100%;}

        .masters{position: absolute;
            bottom: 0;
            left: 0;
            padding: 10px;
            width: 100%;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: flex;
            -webkit-flex-wrap: wrap-reverse;
            -moz-flex-wrap: wrap-reverse;
            -ms-flex-wrap: wrap-reverse;
            flex-wrap: wrap-reverse;}
        .master{display: inline-block;position: relative;margin-right: 6px;margin-top: 6px;z-index: 2}
        .master .image{width: 40px;height: 40px;border-radius: 50%;overflow: hidden;}
        .master .image img{width: 100%;height: 100%;object-fit: cover;}
        .master .image .image_name{width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #2572fa;
            color: #fff;
            text-transform: uppercase;
            font-weight: 600;
            font-size: 14px;}
        .master .count_orders{position: absolute;
            right: -6px;
            top: -6px;
            background: #e73c7e;
            font-size: 14px;
            padding: 4px 7px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 25px;
            color: #fff;
            font-weight: 600;}
        .add_master{  width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px dashed #ddd;cursor: pointer;
            font-size: 14px;opacity: 0;
            visibility: hidden;
            transition: 0.4s;
            color: #bbb;
            border-radius: 50%;}
        .add_master:hover{border: 1px dashed #aaa;
            font-size: 14px;
            color: #444;}
        .day_wrap:hover .add_master{opacity: 1;visibility: visible;}

        .link-days{position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;}
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
                <select class="filter_month" name="year" id="" style="margin-left: 30px">
                    <option value="2022" {{Helper::year(request()->query('year')) == 2022 ? 'selected' : null}}>2022</option>
                    <option value="2023" {{Helper::year(request()->query('year')) == 2023 ? 'selected' : null}}>2023</option>
                    <option value="2024" {{Helper::year(request()->query('year')) == 2024 ? 'selected' : null}}>2024</option>
                </select>
            </form>
        </div>
        <script>
            $('.filter select').on('change', function () {
                $('.filter').submit();
            });
        </script>
        <div class="calendar"><span class="day-name">Пн</span>
            <span class="day-name">Вт</span>
            <span class="day-name">Ср</span>
            <span class="day-name">Чт</span>
            <span class="day-name">Пт</span>
            <span class="day-name">Сб</span>
            <span class="day-name">Вс</span>
            @forelse($previous ?? [] as $pr)
            <div class="day_wrap">
                <a href="?month={{$pr['month']}}">
                    <div class="day day--disabled">
                        {{$pr['day']}}
                    </div>
                </a>
            </div>
            @empty
            @endforelse
            @forelse($days ?? [] as $day)

            <div class="day_wrap" data-day-id="{{$day->id}}">
                <div class="day">
                    {{$day->day}}
                </div>
                <div class="masters">
                    @forelse($day->shifts ?? [] as $shift)
                    <div class="master" {{--onclick="viewShift({{$shift->id}})"--}}>
                        <a href="{{route('week', ['master_id' => $shift->master_id])}}">
                        @if($shift->count_orders)
                        <div class="count_orders">{{$shift->count_orders}}</div>
                        @endif
                        <div class="image">
                            @if($shift->user && $shift->user->img)
                            <img src="https://sun1-47.userapi.com/s/v1/ig2/qRxKIzHeLdKoVVLTuYc3td-n7smrMh0gCXsfH1vI2jJTqb9RakzX5cXPwo5sWyNzAk8jX0eJn9VbJdYZYKuTbU0J.jpg?size=200x200&quality=95&crop=640,0,1920,1920&ava=1" alt="">
                            @elseif($shift->user)
                                <span class="image_name" style="background: {{$shift->user->color ? $shift->user->color : '#2572fa'}}">{{mb_substr($shift->user->name, 0, 2)}}</span>
                            @else
                                <span class="image_name" style="background:#000">ОШИБКА</span>
                            @endif
                        </div>
                        </a>
                    </div>
                    @empty
                    @endforelse
                    <div class="master" onclick="addShift({{$day->id}})">
                    <div class="add_master">
                        <i class="fas fa-plus"></i>
                    </div>
                    </div>
                </div>
                <a href="{{route('days', ['day' => $day->day, 'month' => $day->month, 'year' => $day->year])}}" class="link-days"></a>
            </div>
            @empty
            @endforelse
            @forelse($next ?? [] as $ne)
            <div class="day_wrap">
                <a href="?month={{$ne['month']}}&?year={{$ne['year']}}">
                    <div class="day day--disabled">{{$ne['day']}}</div>
                </a>
            </div>
            @empty
            @endforelse
        </div>
    </div>
</div>

@endsection
