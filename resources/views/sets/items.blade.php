@forelse($items ?? [] as $item)
    <tr data-item="{{$item->id}}" data-item-id="{{$item->id}}" data-position="{{$item->position ?? ''}}">
        <td class="td_sort js_sort">
            <div class="item_sort ui-sortable-handle">
                <i class="fas fa-arrows-alt-v"></i>
            </div>
        </td>
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
            @if($item->service)
                <div class="">{{$item->service->title}}</div>
            @endif
        </td>

        <td class="td_acts">
            <a href="{{route('sets.edit', $item->id)}}" class="act"><i class="fas fa-edit"></i></a>
        </td>
    </tr>
@empty
@endforelse
