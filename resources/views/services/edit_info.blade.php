<div class="ss_edit {{$active ? 'active' : null}}" data-ss="1">
    <div class="ss_item">
        <div class="ss_label"><label for="">Родительская услуга</label></div>
        <select class="ss_select" name="parent_id" id="">
            <option value="">Самостоятельная услуга</option>
            @forelse($services ?? [] as $service)
                <option value="{{$service->id}}" {{$service->id == $item->parent_id ? 'selected' : null}}>{{$service->title}}</option>
            @empty
            @endforelse
        </select>
    </div>
    <div class="ss_item">
        <div class="ss_label"><label for="">Название</label></div>
        <div class="ss_input"><input type="text" name="title"  value="{{$item->title}}"></div>
    </div>
    <div class="ss_item">
        <div class="ss_label"><label for="">Время выполенния услуги (в минутах)</label></div>
        <div class="ss_input"><input type="text" name="mins"  value="{{$item->mins}}"></div>
    </div>
    <div class="ss_item">
        <div class="ss_label"><label for="">Цена</label></div>
        <div class="ss_input"><input type="text" name="price"  value="{{$item->price}}"></div>
    </div>
</div>
