<style>
    .aside_wrap{ width: 200px;
        position: relative;z-index: 3;
        min-width: 200px;
        height: 100vh;transition: all .3s;
        margin: -30px 30px 0 0;
    }
    .aside{
        display: flex;
        flex-direction: column;
        position: fixed;padding: 30px 0;
        top: 0;
        left: 0;
        height: 100vh;
        width: 215px;transition: all .3s;
        padding-left: 15px;
    }

    .header{    margin-bottom: 30px;
        line-height: 1.25;
        display: flex;transition: all .3s;
        justify-content: space-between;
        align-items: center;}
    .logo{}
    .logo{} img{}
    .logo_title{font-size: 24px;font-weight: 900}

    .left_user{display: flex;-webkit-box-align: center;align-items: center;margin-bottom: 40px}
    .left_user_avatar{margin-right: 15px;max-width: 50px;}
    .left_user_name{}
    .left_user_name h3{font-size: 16px;font-weight: 900;color: #0f2a48;margin-bottom: 6px;line-height: 1.25;-webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        display: -webkit-box;
        overflow: hidden;
        text-overflow: ellipsis;}
    .left_user_role{color: #fa5232;margin-bottom: 0;line-height: 1;font-size: 14px;}

    .aside_ul{margin: 0;padding: 0;list-style-type: none;flex: 1}
    .aside_li{margin-bottom: 10px;border-radius: 0 25px 25px 0;padding: 15px 20px;display: flex;color: #2572fa;font-weight: 600;border: solid 1px #2572fa;align-items: center;transition: all .3s;}
    .aside_li:hover{background: #fff;}
    .aside_li_title{font-size: 15px;transition: all .3s;}
    .aside_li.active{background: #2572fa;color: #fff}
    .aside_li .icon{width: 25px;margin-right: 10px}

    .aside_logout{margin-top: 40px}
    .logout_btn{display: flex;color: #0d6efd;font-weight: 600;    align-items: center;}
    .logout_btn .icon{width: 20px;margin-right: 10px;transition: all .3s;}
    .aside_logout_title{font-size: 15px}

    .switch_aside{  font-size: 28px;
        color: #000;
        opacity: 0.75;
        line-height: 1;}
    .switch_aside.open{display: none}
    .aside_wrap.hide{width: 60px;margin-right: 10px;min-width: 60px}

    .aside_wrap.hide .aside{width: 60px}

    .aside_wrap.hide .aside_li_title{opacity: 0;visibility: hidden;display: none;margin-left: 10px}
    .aside_wrap.hide .aside_li .icon{margin-right: 0;width: auto}
    .aside_wrap.hide .aside_li {
        margin-bottom: 10px;
        border-radius: 45px;
        width: 50px;
        min-width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        font-weight: 600;
        position: relative;
        justify-content: center;
    }
    .aside_wrap.hide .left_user_name {
        display: none;
    }
    .aside_wrap.hide .logo_title{display: none}
    .aside_wrap.hide .switch_aside{display: none}
    .aside_wrap.hide .switch_aside.open{display: block}

    .aside_wrap.hide .left_user_avatar {
        margin-right: 0;
    }
    .aside_wrap.hide .left_user{margin-bottom: 30px}
    .aside_wrap.hide .header {
        margin-bottom: 30px;justify-content: center;
    }
    .aside_wrap.hide .logout_btn{justify-content: center}
    .aside_wrap.hide .logout_btn span{display: none}
    .aside_wrap.hide .logout_btn .icon{margin-right: 0}
    .aside_wrap.hide .aside_li:hover{width: 200px;
        min-width: auto;
        display: flex;
        position: relative;
        justify-content: inherit;
       }
    .aside_wrap.hide .aside_li:hover .aside_li_title{opacity: 1;visibility: visible; display: block;   line-height: 1;white-space: nowrap;}

    .aside_li_count{position: absolute;
        right: 4px;
        top: 50%;
        transform: translateY(-50%);
        background: #f60;
        color: #fff;
        display: flex;
        width: 40px;
        height: 40px;
        align-items: center;
        justify-content: center;
        border-radius: 50px;
        font-size: 18px;}
</style>
<div class="aside_wrap js_aside {{$aside ? 'hide' : null}}">
    <div class="aside sidebar ">
        <div class="header">
            <div class="logo_title">ОРХИДЕЯ</div>
            <div class="switch_aside">
                <i class="fal fa-arrow-circle-left"></i>
            </div>
            <div class="switch_aside open">
                <i class="fal fa-arrow-circle-right"></i>
            </div>
        </div>
        <div class="left_user">
            <img class="left_user_avatar" src="/img/user.svg">
            <div class="left_user_name">
                <h3>{{Auth::user()->name}}</h3>
                <p class="left_user_role">Администратор</p>
            </div>
        </div>
        <ul class="aside_ul">
            <li>
                <a href="{{route('pre')}}">
                    <div class="aside_li {{$page == 'pre' ? 'active' : null}}" style="position: relative">
                            <div class="icon"><i class="fad fa-shopping-cart"></i></div><span class="aside_li_title">Заявки</span>
                        @if($count_pre)
                        <div class="aside_li_count">{{$count_pre}}</div>
                        @endif
                    </div>

                </a>
            </li>
            <li>
                <a href="{{route('orders.add')}}">
                    <div class="aside_li {{$page == 3 ? 'active' : null}}">
                        <div class="icon"><i class="fas fa-plus"></i></div><span class="aside_li_title">Запись</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{route('calendar')}}">
                    <div class="aside_li {{$page == 1 ? 'active' : null}}">
                        <div class="icon"><i class="fad fa-calendar-alt"></i></div><span class="aside_li_title">Календарь</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{route('days', ['day' => \Carbon\Carbon::today()->day,'month' => \Carbon\Carbon::today()->month,'year' => \Carbon\Carbon::today()->year])}}">
                    <div class="aside_li {{$page == 4 ? 'active' : null}}">
                        <div class="icon"><i class="fad fa-calendar-day"></i></div><span class="aside_li_title">По дням</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{route('clients')}}">
                    <div class="aside_li {{$page == 2 ? 'active' : null}}">
                        <div class="icon"><i class="fad fa-users"></i></div><span class="aside_li_title">База клиентов</span>
                    </div>
                </a>
            </li>
            @if(Auth::user()->role && Auth::user()->role == 1)
            <li>
                <a href="{{route('services')}}">
                    <div class="aside_li {{$page == 'services' ? 'active' : null}}">
                        <div class="icon"><i class="fas fa-hand-peace"></i></div><span class="aside_li_title">Услуги</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{route('items')}}">
                    <div class="aside_li {{$page == 'items' ? 'active' : null}}">
                        <div class="icon"><i class="fas fa-tags"></i></div><span class="aside_li_title">Товары</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="{{route('log')}}">
                    <div class="aside_li {{$page == 'log' ? 'active' : null}}">
                        <div class="icon"><i class="fas fa-fingerprint"></i></div><span class="aside_li_title">Логирование</span>
                    </div>
                </a>
            </li>
            @endif
        </ul>
        <div class="aside_logout">
            <a href="{{ route('logout') }}" class="logout_btn" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><div class="icon"><i class="fad fa-sign-out-alt"></i></div><span class="aside_logout_title">Выйти из аккаунта</span></a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
<script>
    $('.switch_aside').on('click', function (){

        $.post('{{route('toggle.aside')}}', {_token: '{!! csrf_token() !!}'}, function(data){
            console.log(data);
            if(data == 2){
                $('.js_aside').addClass('hide');
            } else {
                $('.js_aside').removeClass('hide');
            }
            //$(".js_groups_items").append(data);
        });
    })
</script>
