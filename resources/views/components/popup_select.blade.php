<style>
    .select2-container--open .select2-dropdown--below{border-top:none;border-top-left-radius:0;border-top-right-radius:0}
    .select2-dropdown{background-color:#fff;border:1px solid #aaa;border-radius:4px;box-sizing:border-box;display:block;position:absolute;left:-100000px;width:100%;z-index:1051;border:solid 1px #e0f0ff}
    .select2-container--open .select2-dropdown{left:0}
    .select2-results{display:block}
    .select2-container--default .select2-results>.options{max-height:275px;overflow-y:auto}
    .option{padding:6px 20px;cursor:pointer;padding:8px 16px;font-size:16px;line-height:1.5;-moz-user-select:none;-ms-user-select:none;user-select:none;-webkit-user-select:none}
    .option.selected{background-color:#ddd}
    .option:hover{background:#2572fa;color:#fff}
</style>
<span class="select2-container select2-container--default select2-container--open">
   <span class="select2-dropdown select2-dropdown--below">
      <span class="select2-results">
         <ul class="options">
            {{--<li class="option"></li>--}}
             @forelse($items ?? [] as $item)
            <li class="option" data-user-id="{{$item->id}}">{{Helper::phone($item->phone)}} — {{$item->name}}</li>
             @empty
             @endforelse
         </ul>
      </span>
   </span>
</span>
