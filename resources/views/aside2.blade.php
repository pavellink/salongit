<style>
    .aside{width: 55px;
        margin-right: 20px;
        flex: none;
        position: fixed;
        }
    .aside_wrap{display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-flow: column nowrap;
        flex-flow: column nowrap;
        position: relative;
        -webkit-font-smoothing: antialiased;
        min-height: 100vh;}
    .header{margin-bottom: 30px;line-height: 1.25}
    .logo{border-radius: 50%;
        overflow: hidden;}
    .logo img{width: 100%;height: 100%;object-fit: cover}
    .logo_title{font-size: 24px;font-weight: 900}

    .left_user{display: flex;-webkit-box-align: center;align-items: center;margin-bottom: 30px}
    .left_user_avatar{margin-right: 15px;max-width: 50px;}
    .left_user_name{}
    .left_user_name h3{font-size: 18px;font-weight: 900;color: #0f2a48;margin-bottom: 8px;line-height: 1.25;}
    .left_user_role{color: #fa5232;margin-bottom: 0;line-height: 1}

</style>
<div class="aside">
    <div class="aside_wrap">
    <div class="header">
        <div class="logo"><img src="http://salon.loc/img/logo.jpg" alt=""></div>
    </div>
    <div class="left_user">
        <img class="left_user_avatar" src="/img/user.svg">
    </div>
    <style>
        .aside_ul{margin: 0;padding: 0;list-style-type: none;}
        .aside_li{margin-bottom: 7px;
            border-radius: 50%;
            padding: 15px 20px;
            text-align: center;
            height: 55px;
            width: 55px;
            align-items: center;
            display: flex;
            justify-content: center;
            color: #2572fa;
            font-weight: 600;
            border: 2px solid #95befd;}
        .aside_li:hover{background: #fff;}
        .aside_li.active{background: #2572fa;color: #fff;border: 2px solid #2572fa;}
        .aside_li .icon{width: 25px;}
    </style>
    <ul class="aside_ul">
        <li>
            <a href="{{route('orders.add')}}">
                <div class="aside_li {{$page == 3 ? 'active' : null}}">
                    <div class="icon"><i class="fas fa-plus"></i></div>
                </div>
            </a>
        </li>
        <li>
            <a href="{{route('calendar')}}">
                <div class="aside_li {{$page == 1 ? 'active' : null}}">
                    <div class="icon"><i class="fad fa-calendar-alt"></i></div>
                </div>
            </a>
        </li>
        <li>
            <a href="{{route('days', ['day' => \Carbon\Carbon::today()->day,'month' => \Carbon\Carbon::today()->month,'year' => \Carbon\Carbon::today()->year])}}">
                <div class="aside_li {{$page == 4 ? 'active' : null}}">
                    <div class="icon"><i class="fad fa-calendar-day"></i></div>
                </div>
            </a>
        </li>
        <li>
            <a href="{{route('clients')}}">
                <div class="aside_li {{$page == 2 ? 'active' : null}}">
                    <div class="icon"><i class="fad fa-users"></i></div>
                </div>
            </a>
        </li>

    </ul>
        <style>
            .aside_logout{    margin-top: 30px;
                position: fixed;
                bottom: 20px;}
            .logout_btn{display: flex;
                color: #0d6efd;
                font-weight: 600;
                width: 55px;
                height: 55px;
                justify-content: center;
                align-items: center;
                border-radius: 50%;
                border: 2px solid #95befd;}
            .logout_btn:hover{background: #fff}
            .logout_btn .icon{}
        </style>
        <div class="aside_logout">
            <a href="{{ route('logout') }}" class="logout_btn" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><div class="icon"><i class="fad fa-sign-out-alt"></i></div></a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
<div class="aside_back" style="width: 55px;display: table;
    margin-right: 20px;"></div>
