<style>
    .nav_wrap{padding:35px 40px;display:flex;flex-direction:column;gap:25px;align-items:start}
    .nav{left:0;position:fixed;height:100vh;font-size:14px;background:#fff;z-index:30;width:375px;top:0;overflow-y:auto;box-shadow:0 3px 30px rgba(0,0,0,0.1),0 3px 20px rgba(0,0,0,0.1);opacity:0;transform:translateX(-100%);transition:transform .2s ease-out,opacity .2s ease-out;will-change:transform,opacity;scrollbar-width:none;-webkit-overflow-scrolling:touch}
    .nav_wrap .hb_logo_text{color:#444}
    .nav.show{transform:translateX(0);opacity:1}
    .nav.show + .nav_hide{opacity:1;visibility:visible}
    .nav hr{width:100%;display:table;border:none;border-bottom:1px solid #ddd;margin:0;padding:0}
    .nav .nav_title{font-size:14px;margin-bottom:20px}
    .nav ul{margin:0;padding:0;list-style-type:none;width:100%}
    .nav .main_nav{display:flex;flex-direction:column;gap:20px;margin-bottom:10px}
    .nav .main_nav li{margin-bottom:0;font-size:15px}
    .nav .main_nav a{color:#444}
    .nav li{margin-bottom:12px;font-size:15px}
    .nav a{color:#222}
    .nav li .icon{width:24px;display:inline-block;font-size:18px;margin-right:8px;color:var(--text);min-width:24px}
    .nav .subscribers .nav_title{margin-bottom:10px;font-size:16px}
    .nav .nav_socials{display:-ms-flexbox;display:-webkit-flex;display:-moz-flex;display:-ms-flex;display:flex;-webkit-flex-wrap:wrap;-moz-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap}
    .nav .nav_socials .social{width:36px;height:36px;display:flex;justify-content:center;align-items:center;margin-right:4px;margin-bottom:4px;border-radius:50%;background:#1b6f45;color:#fff;font-size:16px;line-height:1}
    .nav .download .nav_title{margin-bottom:10px;font-size:12px}
    .nav .down{display:flex;width:fit-content;background:#fff;padding:5px 10px;border-radius:4px;margin-bottom:5px}
    .nav .down .icon{margin-right:10px}
    .nav .nav_login{margin-bottom:15px;padding-bottom:20px;border-bottom:1px solid #E4E4E4;width:100%}
    .nav .nav_login .login{font-size:20px;line-height:1.25;font-weight:400;padding:16px 32px;border-radius:16px;background:#1b6f45;color:#fff;display:table-caption}
    .nav_hide{width:100%;height:100%;position:fixed;top:0;z-index:25;left:0;opacity:0;visibility:hidden;background:rgba(0,0,0,.75);transition:visibility 0s,opacity .25s linear}
    .nav .nav_cat{margin:0;position:relative}
    .nav_cat a:hover .js_open{opacity:1}
    .nav .nav_cat:hover .cat_subs{opacity:1}
    .nav_cat_item{width:100%;display:flex;justify-content:space-between;padding:12px 0}
    .nav_cat_title{font-size:15px}
    .nav_cat_title:hover{background:#E7E8F9}
    .nav_cat_icon{color:#999;font-size:16px;margin:0 -15px;padding:0 15px}
    .nav_cat_item.active{background:#E7E8F9}
    .nav .cat_subs{z-index:100;display:none;width:100%;border-bottom:1px solid #e4e4e4;padding-bottom:10px;margin-bottom:10px}
    .nav_cat.active .cat_subs{display:table}
    .nav .cat_subs a.cat_sub{font-size:13px!important;padding:10px 0;width:100%;display:flex;justify-content:space-between;align-items:center}
    .cat_sub_arrow{font-size:10px;color:#999;text-align:center}
    .nav::-webkit-scrollbar{width:9px;height:9px;background-color:#fff}
    .nav::-webkit-scrollbar-thumb{background-color:#e5f9ef;border-radius:25px;border-right:solid 3px #fff}
    .nav::-webkit-scrollbar-thumb:hover{background-color:#1b6f45}
    .nav_close{position:absolute;right:30px;top:30px;width:40px;height:40px;display:flex;justify-content:center;align-items:center;font-size:24px;color:#999}
</style>
<style>
    .nav_logo_wrap{display: table;}
    .nav_logo{height: 40px}
    .hb_logo_img{width: 45px;height: 45px}
    .hb_logo_wrap{    display: flex;
        gap: 12px;
        align-items: center;}
    .hb_logo_img img{width: 100%;height: 100%;object-fit: cover}
    .nav_logo img{width: 100%;height: 100%;object-fit: contain}
</style>
<div class="nav js_mobile_nav">
    <div class="nav_wrap">

        <div class="nav_logo_wrap">
            <a href="/" class="hb_logo_wrap">
                <div class="hb_logo_img">
                    <img src="/img/logo.jpg" alt="">
                </div>
                <div class="hb_logo_text">
                    <div class="hb_logo_title">Орхидея</div>
                    <div class="hb_logo_subtitle">Каменск-Уральский</div>
                </div>
            </a>
        </div>
        <div class="nav_close js_nav_close"><i class="fal fa-times"></i></div>
        <hr>
        <style>
            .main_nav_title.phone{font-size: 18px;color: #222}
            .main_nav_subtitle{font-size: 12px;display: block;color: #999}
            .main_nav a{display: flex;align-items: baseline;}
        </style>
        <ul class="main_nav">
            <li>
                @if (Auth::check())
                    <a href="/cabinet">
                        <div class="icon"><i class="far fa-user-circle"></i></div>
                        <div class="main_nav_title">Кабинет</div>
                    </a>
                @else
                    <a href="/vk">
                        <div class="icon"><i class="far fa-user-circle"></i></div>
                        <div class="main_nav_title">Войти через ВК</div>
                    </a>
                @endif
            </li>
        </ul>
        <hr>
        <ul class="main_nav">
            <li>
                <a href="tel:+7 (953) 001-61-11">
                    <div class="icon"><i class="far fa-phone-alt"></i></div>
                    <div class="main_nav_title phone">+7 (953) 001-61-11
                    <div class="main_nav_subtitle">Администратор</div></div>
                </a>
            </li>
            <li>
                <a href="">
                    <div class="icon"><i class="far fa-map-marker-alt"></i></div>
                    <div class="main_nav_title">Каменск-Уральский, ул. Алюминиевая 20</div>
                </a>
            </li>
            <li>
                <a href="">
                    <div class="icon"><i class="far fa-clock"></i></div>
                    <div class="main_nav_title">пн-сб с 09:00 до 20:00, вс с 09:00 до 19:00</div>
                </a>
            </li>
        </ul>
        <div class="">&nbsp;</div>
    </div>
</div>
<div class="nav_hide"></div>
<script>
    $('.nav_cats').on('click', '.js_open', function (e) {
        e.preventDefault();
        $(this).closest('.nav_cat').toggleClass('active')
    });

</script>
<script>
    $(".nav_hide, .js_nav_close").click(function() {
        $('.nav').removeClass("show");
        setTimeout(function () {
            $('.app').empty();
        }, 100);
    });
</script>
