@forelse($items ?? [] as $item)
    <tr>
        {{--<td class="td_id">{{$item->id}}</td>--}}
        <td class="td_user">
            <span>{{$item->user->name}}</span>
        </td>
        <td class="td_act_type">
            {{$item->title}}
        </td>
        <td class="">
            <div class="">{{$item->descr}}</div>
            <div class=""><a href="{{$item->referer}}" target="_blank">{{$item->referer}}</a></div>
        </td>

        <td class="">
            {{Helper::datetime2($item->created_at)}}
        </td>
    </tr>
@empty
@endforelse
