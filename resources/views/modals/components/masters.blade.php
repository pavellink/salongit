@if(isset($users) && count($users) > 0)
@forelse($users ?? [] as $user)
<div class="m_radio">
    <input id="radio-{{$user->master_id}}" type="radio" data-shift="{{$user->id}}" name="master_id" value="{{$user->master_id}}" {{isset($order) && $user->user->id == $order->master_id ? 'checked' : null}} onchange="changeMaster({{$user->id}})">
    <label for="radio-{{$user->master_id}}">{{$user->user->name}}</label>
</div>
@empty
@endforelse
@endif
<script>

</script>
