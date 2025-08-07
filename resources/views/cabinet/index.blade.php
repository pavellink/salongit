@extends('app_index')
@section('content')
    <style>
        .cabinet_container{width: 100%;max-width: 800px;margin: 40px auto}
        .cabinet_title{font-size: 34px;font-weight: 900;}
        .cabinet_main{display: flex;flex-direction: column;gap: 12px;margin: 30px 0}
        .cabinet_main_li{background: #fff;border-radius: 12px;padding: 30px 30px;display: flex;justify-content: space-between;align-items: center;}
        .cabinet_main_li.act{cursor: pointer;text-decoration: none;color: #222}
        .cabinet_main_li.act:hover{background: #e73c7e;color: #fff;font-weight: 600}
        .cabinet_main_li_icon{color: #888}
        .cabinet_main_li.act:hover .cabinet_main_li_icon{color: #fff}
    </style>
    <div class="cabinet_container">

        <div class="cabinet_title">Личный кабинет</div>
        <div class="cabinet_main">
            <div class="cabinet_main_li">
                <div class="cabinet_main_li_title">Бонусы: <b>{{$user->count_bonuses ?? 0}}</b>
                    <br>Уровень: {{$lvl->title}} - {{$lvl->percent}}%
                </div>
            </div>
<!--            <div class="cabinet_main_li act">
                <div class="cabinet_main_li_title">Записаться</div>
                <div class="cabinet_main_li_icon"><i class="fas fa-chevron-right"></i></div>
            </div>
            <div class="cabinet_main_li act">
                <div class="cabinet_main_li_title">История посещений</div>
                <div class="cabinet_main_li_icon"><i class="fas fa-chevron-right"></i></div>
            </div>-->
            <a href="{{route('verifi')}}" class="cabinet_main_li act">
                <div class="cabinet_main_li_title">Мои данные</div>
                <div class="cabinet_main_li_icon"><i class="fas fa-chevron-right"></i></div>
            </a>

            <a href="{{ route('logout') }}" class="cabinet_main_li act" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <div class="cabinet_main_li_title">Выйти</div>
                <div class="cabinet_main_li_icon"><i class="fas fa-sign-out"></i></div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

@endsection
