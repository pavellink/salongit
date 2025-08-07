<div class="block" style="margin: 60px 0 80px">
    <div class="block_title">Услуги</div>
    <div class="block_subtitle">Ниже представлен список оказываемых нами услуг с ориентировочным временем, актуальными ценами. Дополнительно оплачиваются расходные материалы (краска, оксид, пудра, ньютон... в зависимости от услуги)</div>

    <div class="swiper block_swiper js_swiper_services">
        <div class="swiper-wrapper">
            @forelse($services ?? [] as $service)
                <div class="swiper-slide block_item">
                    <div class="block_item_title">{{$service->title}}</div>
                    @if($service->price)

                        <div class="block_item_price">
                            {{$service->price}}
                            <span>руб.</span>
                        </div>
                        <div class="block_item_dops">{{$service->mins}} мин.</div>
                    @endif
                    @if($service->min_time || $service->max_time)

                        <div class="block_item_price">
                            @if($service->min_price != $service->max_price)
                                {{$service->min_price}} - {{$service->max_price}}
                            @else
                                {{$service->min_price}}
                            @endif
                            <span>руб.</span>
                        </div>
                        <div class="block_item_dops">
                            @if($service->is_set)
                                + расходные материалы.
                            @endif
                            @if($service->min_time != $service->max_time)
                                {{$service->min_time}} - {{$service->max_time}} мин.
                            @else
                                {{$service->min_time}} мин.
                            @endif

                        </div>
                    @endif
                    {{-- <div class="block_item_link">Записаться</div>--}}
                </div>
            @empty
            @endforelse
        </div>
    </div>
    <script>
        $(document).ready(function() {
            let swiper = new Swiper(".js_swiper_services", {
                spaceBetween: 12,
                slidesPerView: 'auto',
            });
        });
    </script>
</div>
