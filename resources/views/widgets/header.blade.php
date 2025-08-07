<style>
    .header{display: flex;justify-content: space-between;align-items: center;padding: 25px 30px;background: #fff;border-radius: 12px;margin-top: 8px}
    .header_logo{display: flex;align-items: center;gap: 12px}
    .header_logo_image{width: 45px;height: 45px;overflow: hidden;border-radius: 4px;}
    .header_logo_image img{width: 100%;height: 100%;object-fit: contain}
    .header_logo_title{font-size: 24px;color: #222;font-weight: 600}
    .header_address{    display: flex;font-weight: 600;
        align-items: center;gap: 8px;color: #222;
        cursor: pointer;}
    .header_social{}
    .ht_social{}
    .ht_social_items{margin:0;padding:0;list-style-type:none;display:flex}
    .ht_social_item{opacity:.5;transition:opacity .2s ease-in-out;display:flex;align-items:center;border-radius:4px;overflow:hidden}
    .ht_social_item:hover{opacity:1;background:#f4f4f4}
    .ht_social_item_link{color:#fff;padding:3px 8px}
    .header_right{display: flex;gap: 20px;align-items: center;}
    .header_phone{font-size: 18px;color: #222;font-weight: 600;}
    .header_in{    padding: 15px 25px;
        background: #e73c7e;
        color: #fff;
        border-radius: 8px;
        line-height: 1.25;
        text-decoration: none;
        display: block;
        font-size: 16px;
        font-weight: 600;}
    .header_in:hover{color: #fff}
</style>
<div class="container">
    <div class="header">
        <a href="/" class="header_logo">
            <div class="header_logo_image">
                <img src="/img/logo.jpg" alt="">
            </div>
            <div class="header_logo_title">ОРХИДЕЯ</div>
        </a>
        <div class="header_address">
            <i class="far fa-location-arrow"></i><span>Каменск-Уральский, Алюминиева 20</span>
        </div>
        <div class="header_social">
            <ul class="ht_social_items">
                <li class="ht_social_item"><a href="https://vk.com/club150404756" class="ht_social_item_link" target="_blank" style="color: #2787f5"><i class="fab fa-vk"></i></a></li>
            </ul>
        </div>
        <div class="header_right">
            <a href="tel:+7 (953) 001-61-11" class="header_phone">+7 (953) 001-61-11</a>
            @if (Auth::check())
                <a href="/cabinet" class="header_in">Личный кабинет</a>
            @else
                <a href="/vk" class="header_in">Войти через ВК</a>
            @endif
        </div>
    </div>
</div>
<style>
    @media(max-width:992px) {
.header{display: none}
    }
    @media (max-width: 375px) {

    }
    .hm{display:flex;justify-content:space-between;align-items:center;gap:20px;padding:12px 15px;position:fixed;width:100%;top:0;left:0;background: #fff;z-index: 20;}
    .hm_back{display:table;width:100%;height:60px}
    .hb_logo_text{color: #222}
    .hm_left{display:flex;gap:20px;align-items:center}
    .hm_burder2{font-size:16px;display:flex;width:36px;height:36px;align-items:center;justify-content:center;background:#e73c7e;border-radius:6px;color: #fff}
    .hm_logo_img{height:36px}
    .hm_logo_img img{width:100%;height:100%;object-fit:contain}
    .hm_acts{display:flex;gap:8px}
    .hm_act{font-size:16px;display:flex;width:36px;height:36px;align-items:center;justify-content:center;background:#e73c7e;border-radius:6px;}
    .hm_act a{color:#fff}

    .hb_logo_text {
        color: #222;
    }

    .hb_logo_text {
        font-size: 18px;
        font-weight: 700;
        color: #444;
    }
    .hb_logo_title {
        line-height: 1;
    }
    .hb_logo_subtitle {
        font-size: 13px;
        line-height: 1.25;
        font-weight: 400;

    }

    @media(min-width:993px) {
        .hm{display: none}
        .hm_back{display: none}
    }

</style>
<div class="hm">
    <div class="hm_left">
        <div class="hm_burder2 js_open_hm">
            <i class="far fa-bars"></i>
        </div>
        <div class="hm_logo">
            <a href="/" class="hb_logo_wrap">
                <div class="hb_logo_text">
                    <div class="hb_logo_title">ОРХИДЕЯ</div>
                    <div class="hb_logo_subtitle">Каменск-Уральский</div>
                </div>
            </a>
        </div>
    </div>
    <div class="hm_acts">
        <div class="hm_act"><a href="tel:+79530016111"><i class="far fa-phone-alt"></i></a></div>
    </div>
</div>
<div class="hm_back"></div>
@include('widgets.mobile_nav')
<script>
    $('.js_open_hm').on('click', function (){
        $('.js_mobile_nav').toggleClass('show');
    })
</script>
