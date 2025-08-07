@extends('app')
@section('content')
    @widget('aside', ['page' => 'sets'])
    <div class="page_content">
        <style>
            .edit_tabs{display: table;margin-top: 15px;}
            .edit_tabs .edit_tab{cursor: pointer;margin-right: 25px;display: inline-block;font-size: 15px;margin-bottom: -3px;padding-bottom: 10px;color: #1a73e8;}
            .edit_tabs .edit_tab.active{border-bottom: 3px solid #537ad6;}
        </style>
        <div class="main_block">
            <h1 class="page_title">{{$item->title}}: {{$item->service ? $item->service->title : null}}</h1>
        </div>
        <form action="{{route('sets.update', $item->id)}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="item_id" value="{{$item->id}}">
            <div class="main_block">
                <div class="admin_content">
                    <div class="ss_edit active" data-ss="1">
                        <style>
                            .edit_set{}
                            .edit_set_title{}
                            .edit_set_items{margin: -30px -40px}

                            .edit_set .set_line:nth-child(even) {background-color: #f8f8f8;}
                            .edit_set .set_line:hover{background: }
                            .edit_set .set_table{font-size: 15px }
                            .edit_set .set_table .set_table{border: none}
                            .edit_set .set_thead{}

                            .edit_set .set_tfoot{}
                            .edit_set .set_tr{border-bottom: 0;background: none}
                            .edit_set .set_th{border: none;border-bottom: 1px solid #ddd;border-right: 1px solid #ddd;    padding: 15px 15px;}
                            .edit_set .set_tfoot .set_th{border-bottom: 0;padding: 5px 15px;font-size: 15px}
                            .edit_set .set_th:last-child{border-right: 0}
                            .edit_set .set_td{border: none;border-bottom: 1px solid #ddd;border-right: 1px solid #ddd;    padding: 5px 15px;}
                            .edit_set .set_td.set_items{padding: 0}
                            .edit_set .set_items .set_td{width: 33%}
                            .edit_set .set_td:last-child{border-right: 0}

                            .js_add_item{color: #0d6efd;font-size: 15px;cursor: pointer}
                            .set_td_select{margin: -5px -15px;
                                padding: 5px 15px;width: 100%;
                                background: none;}
                            .set_td_input{margin: -5px -15px;
                                padding: 5px 15px;width: 100%;
                                background: none;}
                            .set_td_act{color: #0d6efd;cursor: pointer}
                        </style>
                        <div class="edit_set">

                            <div class="edit_set_items">
                                <table class="set_table">
                                    <tbody class="js_table">
                                    @forelse($service->subs as $sub)
                                        <tr class="set_tr set_line js_set">
                                            <td class="set_td">{{$sub->title}}</td>
                                            <td class="set_td set_items">
                                                <table class="set_table">
                                                    @if($loop->first)
                                                        <thead class="set_thead">
                                                        <tr class="set_tr">
                                                            <th class="set_th">Товар</th>
                                                            <th class="set_th">Расход</th>
                                                            <th class="set_th">Цена</th>
                                                            <th class="set_th"></th>
                                                        </tr>
                                                        </thead>
                                                    @endif
                                                    <tbody class="js_items">
                                                    @forelse($sub->setItems ?? [] as $setItem)
                                                        @include('sets.tr')
                                                    @empty
                                                    @endforelse
                                                    <tr class="set_tr js_before">
                                                        <td class="set_td js_add_item" data-service="{{$sub->id}}" data-set="{{$item->id}}">+ Добавить товар</td>
                                                        <td class="set_td"></td>
                                                        <td class="set_td"></td>
                                                        <td class="set_td"></td>
                                                    </tr>

                                                    </tbody>
                                                    <tfoot class="set_tfoot">
                                                    <tr class="set_tr">
                                                        <th class="set_th">Итого</th>
                                                        <th class="set_th"></th>
                                                        <th class="set_th">{{$sub->total ?? 0}} Р</th>
                                                        <th class="set_th"></th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                                <script>
                                    $('.js_table').on('click', '.js_add_item', function (){
                                        let set_id = $(this).attr('data-set');
                                        let service_id = $(this).attr('data-service');
                                        let parent = $(this).closest('.js_items');
                                        $.post('{{route('setItems.add')}}', {set_id: set_id, service_id: service_id, _token: '{!! csrf_token() !!}'}, function(data){
                                            console.log(data);
                                            parent.find('.js_before').before(data)
                                        });
                                    });
                                    $('.js_table').on('click', '.js_delete', function (){
                                        let set_id = $(this).attr('data-id');
                                        let parent = $(this).closest('.js_set_item');
                                        $.post('{{route('setItems.delete')}}', {set_id: set_id, _token: '{!! csrf_token() !!}'}, function(data){
                                            console.log(data);
                                            parent.remove();
                                        });
                                    })
                                </script>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="main_block">
                <div class="order_form_item">
                    <button class="order_button" type="submit">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
@endsection
