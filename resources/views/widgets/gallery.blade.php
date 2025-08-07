<div class="block">
    <div class="block_title">Фотографии</div>

    <div class="swiper block_swiper js_swiper_gallery">
        <div class="swiper-wrapper">
            @forelse([1,2,3,4,5,6] as $num)
            <div class="swiper-slide block_item image">
                <div class="block_item_image">
                    <img src="/img/s{{$num}}.jpg" alt="">
                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
    <script>
        $(document).ready(function() {
            let swiper = new Swiper(".js_swiper_gallery", {
                spaceBetween: 12,
                slidesPerView: 'auto',
            });
        });
    </script>
</div>
