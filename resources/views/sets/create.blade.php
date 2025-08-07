@extends('app')
@section('content')
    @widget('aside', ['page' => 'services'])
    <div class="page_content">
        <style>
            .edit_tabs{display: table;margin-top: 15px;}
            .edit_tabs .edit_tab{cursor: pointer;margin-right: 25px;display: inline-block;font-size: 15px;margin-bottom: -3px;padding-bottom: 10px;color: #1a73e8;}
            .edit_tabs .edit_tab.active{border-bottom: 3px solid #537ad6;}
        </style>
        <div class="main_block ">
            <h1 class="page_title">Добавление комплектации</h1>
        </div>
        <form action="{{route('sets.store')}}" method="post">
            {{ csrf_field() }}
            <div class="main_block">
                <div class="admin_content">
                    <div class="ss_edit active" data-ss="1">
                        <div class="ss_item">
                            <div class="ss_label"><label for="">Выберите услугу</label></div>
                            <select class="ss_select" name="service_id" id="" required>
                                @forelse($services ?? [] as $service)
                                    <option value="{{$service->id}}">{{$service->title}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="ss_item">
                            <div class="ss_label"><label for="">Название</label></div>
                            <div class="ss_input"><input type="text" name="title" value="" required></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="main_block">
                <div class="order_form_item">
                    <button class="order_button" type="submit">Добавить</button>
                </div>
            </div>
        </form>
    </div>
@endsection
