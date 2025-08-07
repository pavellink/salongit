<div class="ss_edit {{$active ? 'active' : null}}" data-ss="1">

    <div class="ss_item">
        <div class="ss_label"><label for="">Название</label></div>
        <div class="ss_input"><input type="text" name="title"  value="{{$item->title}}"></div>
    </div>
    <div class="ss_item">
        <div class="ss_label"><label for="">Шаг</label></div>
        <div class="ss_input"><input type="text" name="step"  value="{{$item->step}}"></div>
    </div>
    <div class="ss_item">
        <div class="ss_label"><label for="">Цена</label></div>
        <div class="ss_input"><input type="text" name="price"  value="{{$item->price}}"></div>
    </div>
</div>
