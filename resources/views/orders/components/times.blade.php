@forelse($times ?? [] as $time)
    <div class="order_time">{{Helper::time($time->time_start)}}-{{Helper::time($time->time_finish)}}</div>
@empty
@endforelse
