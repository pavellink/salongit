@forelse($items ?? [] as $item)
    <tr>
        <td class="td_id">{{$item->id}}</td>
        <td class="td_name">{{$item->name}}</td>
        <td class="td_phone">
            <div class="">
                @if($item->phone)
                    <div class="btn_show_phone" onclick="getContact({{$item->id}})">
                        {{Helper::phone($item->phone)}}
                    </div>
                @endif
            </div>
        </td>
        <td>
            @if($item->count_orders)
            <a href="{{route('history.view', ['user_id' => $item->id])}}" target="_blank">{{$item->count_orders}}</a>
            @endif
        </td>
        <td>@if($item->bonus_lvl){{$item->bonus_lvl->title ?? null}} {{'('.$item->bonus_lvl->percent.'%)' ?? null}}@endif</td>
        <td>{{$item->count_bonuses ?? 0}}</td>
        <td class="td_acts">
            <a href="{{route('clients.edit', $item->id)}}" class="act"><i class="fas fa-edit"></i></a>
        </td>
    </tr>
@empty
@endforelse
