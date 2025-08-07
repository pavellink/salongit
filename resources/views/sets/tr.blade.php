<tr class="set_tr js_set_item" data-id="{{$setItem->id}}">
    <td class="set_td">
        <select class="set_td_select" name="sets[{{$setItem->service_id}}][{{$setItem->id}}][product_id]" id="">
            <option value="">Выберите из списка</option>
            @forelse($products ?? [] as $product)
                <option value="{{$product->id}}" {{$product->id == ($setItem->product ? $setItem->product->id : null) ? 'selected' : null}}>{{$product->title}} ({{$product->price}} ₽)</option>
            @empty
            @endforelse
        </select>
    </td>
    <td class="set_td"><input class="set_td_input" type="text" name="sets[{{$setItem->service_id}}][{{$setItem->id}}][qty]" value="{{$setItem->qty}}"></td>
    <td class="set_td">@if($setItem->product){{$setItem->product->price * $setItem->qty}} Р @endif</td>
    <td class="set_td"><a class="set_td_act js_delete" data-id="{{$setItem->id}}"><i class="fas fa-trash-alt"></i></a></td>
</tr>
