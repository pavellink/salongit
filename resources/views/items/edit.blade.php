@extends('app')
@section('content')
    @widget('aside', ['page' => 'items'])
    <div class="page_content">
        <style>
            .edit_tabs{display: table;margin-top: 15px;}
            .edit_tabs .edit_tab{cursor: pointer;margin-right: 25px;display: inline-block;font-size: 15px;margin-bottom: -3px;padding-bottom: 10px;color: #1a73e8;}
            .edit_tabs .edit_tab.active{border-bottom: 3px solid #537ad6;}
        </style>
        <div class="main_block with_tab">
            <h1 class="page_title">Редактирование товара</h1>
            <div class="edit_tabs">
                <div class="edit_tab active" data-tab="1">Основная информация</div>
            </div>
        </div>
        <form action="{{route('items.update', $item->id)}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="item_id" value="{{$item->id}}">
            <div class="main_block">
                <div class="admin_content">
                    @include('items.edit_info', ['active' => true])
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
