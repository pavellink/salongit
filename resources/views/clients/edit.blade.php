@extends('app')
@section('content')
    @widget('aside', ['page' => 2])
    <div class="page_content">
        <div class="main_block">
            <h1 class="page_title">Редактирование клиента</h1>
        </div>
        <form action="{{route('clients.update', $item->id)}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="item_id" value="{{$item->id}}">
            <div class="main_block">
                <div class="admin_content">
                    <div class="ss_edit active" data-ss="1">
                        <div class="ss_item">
                            <div class="ss_label"><label for="">Имя</label></div>
                            <div class="ss_input"><input type="text" name="name"  value="{{$item->name}}"></div>
                        </div>
                        <div class="ss_item">
                            <div class="ss_label"><label for="">Телефон</label></div>
                            <div class="ss_input"><input type="text" name="phone"  value="{{$item->phone}}"></div>
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
