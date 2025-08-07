@forelse($items ?? [] as $item)
    <tr>
        <td>
            <div class="pre_td">
                <div class=""><b>{{$item->title}}</b></div>
                <div class="">Услуга: {{$item->service->parent ? $item->service->parent->title.': ' : null }}{{$item->service->title}}</div>
                <div class="">Выбрана дата: {{Helper::date($item->date_at)}}</div>

                @if($item->status_id <=2)
                <a href="{{route('orders.pre', ['pre_id' => $item->id])}}" target="_blank" style="display: block;margin-top: 10px">Записать</a>
                @endif
            </div>
        </td>
        <td>
            <div class="pre_td">
                <div class=""><b>{{$item->user->name}} {{$item->user->name2}}</b></div>
                <div class="" onclick="getContact({{$item->user_id}})">{{Helper::phone($item->user->phone)}}</div>
            </div>
        </td>
        <td>
        @if($item->status)
           <b> <div class="">{{$item->status->title}}</div></b>
        @endif
        @if($item->manager)
            <div class="" style="margin-top: 10px">{{$item->manager->name}} {{$item->manager->name2}}</div>
        @else
            <div class="" style="margin-top: 10px">Ожидание: <b>{{Helper::timer($item->created_at)}}</b></div>
        @endif
            <div class="" style="margin-top: 10px">Дата заявки: {{Helper::datetime($item->created_at)}}</div>
        </td>
        <td class="td_acts">
            <a href="{{route('pre.edit', $item->id)}}" class="act"><i class="fas fa-edit"></i></a>
        </td>
    </tr>
@empty
@endforelse
