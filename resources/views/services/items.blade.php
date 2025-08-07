@forelse($items ?? [] as $item)
    <tr data-item="{{$item->id}}" data-item-id="{{$item->id}}" data-position="{{$item->position ?? ''}}">
        <td>
            <div class="item_content">
                <div class="info">
                    <div class="title">{{$item->parent ? ($item->parent->nav_title ? $item->parent->nav_title : $item->parent->title).': ' : null}}{{$item->title}}</div>
                </div>
                @if($subs && count($item->subs) > 0)
                    <div class="subs">
                        @forelse($item->subs ?? [] as $sub)
                            <div class="sub_item" data-item="{{$sub->id}}"><i class="arrow fad fa-long-arrow-alt-right"></i> {{$sub->title}} — {{$sub->mins}} мин. / {{$sub->price ?? 0}} ₽
                                <a href="{{route('services.edit', $sub->id)}}" class="sub_act"><i class="fad fa-edit"></i></a>
                                <a onclick="del({{$sub->id}})" class="sub_act"><i class="fad fa-trash-alt"></i></a>
                            </div>
                        @empty
                        @endforelse
                    </div>
                @endif
                <div class="title_bottom">
                    <div class="title_dop">{{$item->updated_at ? 'Обновлено:' : 'Добавлено:'}} <span>{{Helper::datetime($item->updated_at ? $item->updated_at : $item->created_at)}}</span></div>
                </div>
            </div>
        </td>
        <td>
            @if($item->mins)

                    <div class="">{{$item->mins}} мин. </div>

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
            <a href="{{route('services.edit', $item->id)}}" class="act"><i class="fas fa-edit"></i></a>
        </td>
    </tr>
@empty
@endforelse
