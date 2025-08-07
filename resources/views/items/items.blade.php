@forelse($items ?? [] as $item)
    <tr data-item="{{$item->id}}" data-item-id="{{$item->id}}" data-position="{{$item->position ?? ''}}">
        <td>
            <div class="item_content">
                <div class="info">
                    <div class="title">{{$item->title}}</div>
                </div>
                <div class="title_bottom">
                    <div class="title_dop">{{$item->updated_at ? 'Обновлено:' : 'Добавлено:'}} <span>{{Helper::datetime($item->updated_at ? $item->updated_at : $item->created_at)}}</span></div>
                </div>
            </div>
        </td>
        <td>
            @if($item->step)
                <div class="">{{$item->step}}</div>
            @endif
        </td>
        <td>
            @if($item->price)
            <div class="item_price_wrap">
                <div class="item_price">{{$item->price}} ₽ </div>
                @if($item->price2)<div class="item_price2">{{$item->price2}} ₽</div>@endif
            </div>
            @if($item->price2)
                <div class="item_sale">
                    <div class="item_sale_wrap">
                        @if($item->percent)<div class="item_sale_percent">-{{$item->percent}}%</div>@endif
                        <div class="item_sale_sum">Скидка {{$item->price2 - $item->price}} ₽</div>
                    </div>
                </div>
            @endif
            @endif
        </td>
        <td class="td_acts">
            <a href="{{route('items.edit', $item->id)}}" class="act"><i class="fas fa-edit"></i></a>
        </td>
    </tr>
@empty
@endforelse
