@extends('app_index')
@section('content')
    <div class="container-lg">
        <style>
            .banner_one_wrap{padding-bottom: 50%;
                width: 100%;
                position: relative;
                border-radius: 12px;
                overflow: hidden;
                margin: 40px 0 40px;
            }
            .banner_one{position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;}
            .banner_one img{    width: 100%;
                height: 100%;
                object-fit: cover;}
        </style>
        <div class="banner_one_wrap">
            <div class="banner_one">
                <img src="/img/dr500.jpg" alt="">
            </div>
        </div>

        <style>
            .block_descr{margin: 20px 0;font-size: 16px}
        </style>
        <div class="block" style="margin: 30px 0 30px">
            <div class="block_title"><h1 style="font-weight: 900">Дарим 500 бонусов на День Рождения!</h1></div>
        </div>
        <style>
            .steps{display: flex;flex-direction: column;gap: 20px}
            .step{display: flex;flex-direction: column;gap: 10px;    align-items: start;}
            .step_title{}
            .step_select{padding: 15px 20px;
                background: #fff;
                border-radius: 12px;margin: 10px 0;display: block;
                border: none;max-width: 275px;}
            .step_btn{padding: 20px 30px;background: #fff;border-radius: 12px;display: table;border: none}
        </style>
        <div class="steps">
            <div class="block_title">Как получить?</div>
            <div class="step">
                <div class="step_title"><b>Шаг 1</b></div>
                @if (Auth::check())
                <div class="step_btn" style="color: #1bba0c;font-weight: 600;">
                    Авторизоваться на сайте — успешно
                </div>
                @else
                    <a href="/vk?dr=true" class="step_btn" target="_blank">
                        Авторизоваться на сайте через ВК
                    </a>
                @endif
            </div>
            <div class="step">
                <div class="step_title"><b>Шаг 2</b></div>
                @if (Auth::check() && Auth::user()->dob)
                <div class="step_btn" style="color: #1bba0c;font-weight: 600;">
                    Указать дату рождения в формате дд.мм.гг — успешно
                </div>
                @else
                <a href="/verifi" class="step_btn" target="_blank">
                    Указать дату рождения в формате дд.мм.гг
                </a>
                @endif
            </div>
            <div class="step">
                <div class="step_title"><b>Шаг 3</b></div>
                @if (Auth::check() && Auth::user()->dob && Auth::user()->dob_bonus)
                    <div class="step_btn" style="color: #1bba0c;font-weight: 600;">
                        Получить бонусы — успешно
                    </div>
                @else
                    <a href="/get-dr-500" class="step_btn" target="_blank">
                        Получить бонусы
                    </a>
                @endif
            </div>
            @if (Auth::check() && Auth::user()->dob && Auth::user()->dob_bonus)
                <div class="step">
                    <div class="step_title"><b>Шаг 4</b></div>
                    @if (Auth::check() && Auth::user()->dob && Auth::user()->dob_bonus)
                        <form action="{{route('preOrder')}}" method="POST">
                        @csrf
                        <select class="step_select" name="service_id" id="" required>
                            <option value="">Выберите услугу</option>
                            @forelse($services ?? [] as $service)
                            <option value="{{$service->id}}">{{$service->title}}</option>
                            @empty
                            @endforelse
                        </select>
                        <select class="step_select" name="date_at" id="" required>
                            <option value="">Выберите дату</option>
                            @forelse($dates ?? [] as $date)
                            <option value="{{$date->format('Y-m-d')}}"  {{$date->format('Y-m-d') < $now->format('Y-m-d') ? 'disabled' : null}}>{{Helper::date($date->format('Y-m-d'))}}</option>

                            @empty
                            @endforelse

                        </select>
                        <button type="submit" class="step_btn" style="background: #e73c7e;
    color: #fff;font-weight: 600;cursor: pointer">
                            Записаться
                        </button>
                    </form>
                    @endif
                </div>
            @endif
        </div>
        <div class="block">
            <div class="block_descr"><p>У Вас День Рождения? «ОРХИДЕЯ» дарит 500 бонусных рублей! Акция доступна всем, у кого зарегистрирован личный кабинет ОРХИДЕЯ. Для получения бонусных баллов необходимо указать в личном кабинете дату Вашего рождения в формате дд.мм.гг. Ровно за три дня до указанной даты Вам на мобильный телефон поступит СМС с информацией о начислении бонусов. Использовать бонусные баллы можно в течение 10 дней: за три дня до праздника, в день рождения и 6 дней после него. Бонусными баллами можно оплатить до 30% от суммы услуги! Бонусами нельзя оплатить расходные материалы или товары. <b>Акция действует только при заказе через сайт.</b> Предложение не распространяется на заказы, сделанные оффлайн в салоне красоты (пришли с улицы). Баллы начисляются 1 раз в год в течение календарного года. Для подтверждения необходимо будет предоставить документы (например: паспорт или водительские права)</p>
                <p>Заказывайте на ku-salon.ru и по тел. <a href="tel:+79530016111">+7 (953) 001-61-11</a></p></div>
        </div>
    </div>
    <div class="container-lg">
        @widget('services')
        @widget('tizers')
        @widget('gallery')
        @widget('map')
    </div>
@endsection
