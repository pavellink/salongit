@extends('app')
@section('content')
    @widget('aside', ['page' => 'pre'])
    <div class="page_content">
        <style>
            .edit_tabs{display: table;margin-top: 15px;}
            .edit_tabs .edit_tab{cursor: pointer;margin-right: 25px;display: inline-block;font-size: 15px;margin-bottom: -3px;padding-bottom: 10px;color: #1a73e8;}
            .edit_tabs .edit_tab.active{border-bottom: 3px solid #537ad6;}
        </style>
        <div class="main_block with_tab">
            <h1 class="page_title">Редактирование заявки</h1>
            <div class="edit_tabs">
                <div class="edit_tab active" data-tab="1">Основная информация</div>
            </div>
        </div>
        <form action="{{route('pre.update', $item->id)}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="item_id" value="{{$item->id}}">
            <div class="main_block">
                <div class="admin_content">
                    <div class="ss_item">
                        <div class="ss_label"><label for="">Название</label></div>
                        <div class="ss_input"><input type="text" name=""  value="{{$item->title}}" disabled></div>
                    </div>
                    <div class="ss_item">
                        <div class="ss_label"><label for="">Услуга</label></div>
                        <div class="ss_input"><input type="text" name=""  value="{{$item->service->parent ? $item->service->parent->title.': ' : null }}{{$item->service->title}}" disabled></div>
                    </div>
                    <div class="ss_item">
                        <div class="ss_label"><label for="">Хочу на дату</label></div>
                        <div class="ss_input"><input type="text" name=""  value="{{Helper::date($item->date_at)}}" disabled></div>
                    </div>
                    <div class="ss_item">
                        <div class="ss_label"><label for="">Клиент</label></div>
                        <div class="ss_input"><input type="text" name=""  value="{{$user->name}} {{$user->name2}}" disabled></div>
                    </div>
                    <div class="ss_item">
                        <div class="ss_label"><label for="">Статус</label></div>
                        <select class="ss_select" name="status_id" id="">
                            <option value="">Выберите из списка</option>
                            @forelse($statuses ?? [] as $status)
                                <option value="{{$status->type}}" {{$status->type == $item->status_id ? 'selected' : null}}>{{$status->title}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="ss_item">
                        <div class="ss_label"><label for="">Комментарий</label></div>
                        <textarea class="ss_textarea" name="descr" id="" placeholder="Если клиент отказался - напишите причину отказа">{{$item->descr}}</textarea>
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
