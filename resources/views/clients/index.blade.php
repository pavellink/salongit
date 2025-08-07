@extends('app')
@section('content')
@widget('aside', ['page' => 2])
<div class="page_content">
    <style>
        .add_btn{display: table;
            padding: 10px 20px;
            background: #2572fa;
            color: #fff;
            border-radius: 4px;
            font-size: 15px;margin-left: 12px;}
    </style>
    <div class="main_block" style="display: flex;align-items: center;justify-content: space-between">
        <h1 class="page_title">Клиенты</h1>
        <a href="{{route('clients.create')}}" class="add_btn">Добавить</a>
    </div>
    <style>
        table {border-collapse: collapse;width: 100%;font-size: 16px;background: #fff;}
        table, th {border-bottom: 1px solid #ddd;}
        tr{border-bottom: 1px solid #ddd;}
        tr:last-child{border-bottom: 0}
        th, td{padding: 10px 20px;border-right: 1px solid #ddd}
        th:last-child, td:last-child{border-right: 0}
        thead{border-collapse: separate;}
        thead th{padding: 15px 20px;}
        tbody{border-collapse: separate;}
        td:first-child{padding-left: 20px}
        td:last-child{padding-right: 20px}
        .td_id{width: 75px;text-align: center;white-space: nowrap}
        .td_name{}
        .td_phone{}
        .td_acts{width: 150px;text-align: right;white-space: nowrap}
        .td_acts button{width: 100%;background: #bbb;color: #fff;padding: 6px 14px;border-radius: 4px;}
        th input{width: 100%;padding: 10px 10px;border: 1px solid #ddd;border-radius: 6px;    min-width: 55px;}
        tr:nth-child(2n) {background:#f8fafc;}
        .btn_show_phone{display: table;background: #ffffff;border-radius: 25px;color: #222;padding: 2px 8px;border: 1px solid #bbb;}
    </style>

    <form action="" id="update_clients" method="GET">
    </form>
    <div class="main_block" style="padding: 0">
        <table>
            <thead>
                <tr>
                    <th class="td_id">id</th>
                    <th class="td_name">Имя Фамилия</th>
                    <th class="td_phone">Телефон</th>
                    <th class="">Посещений</th>
                    <th class="">Уровень</th>
                    <th class="">Баллы</th>
                    <th class="td_acts"></th>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th class="td_id"><input form="update_clients" class="js_keyup" name="user_id" type="text" autocomplete="off" value="{{request()->query('user_id')}}"></th>
                    <th class="td_name"><input form="update_clients" class="js_keyup" name="name" type="text" autocomplete="off" value="{{request()->query('name')}}"></th>
                    <th class="td_phone"><input form="update_clients" class="js_keyup" name="phone" type="text" autocomplete="off" value="{{request()->query('phone')}}" placeholder="+7 ___ ___-__-__"></th>
                    <th class=""></th>
                    <th class=""></th>
                    <th class=""></th>
                    <th class="td_acts"></th>
                </tr>
            </thead>
            <tbody class="js_html">
            @include('clients.items')
            </tbody>
        </table>
    </div>
    <div class="main_block">
        {!! $items->appends(request()->input())->links(); !!}
    </div>

<script>
    $('.js_keyup').on('keyup',function(I) {
        switch(I.keyCode) {
            case 13:
            case 27:
            case 38:
            case 40:
                break;
            default:
                $.ajax({
                    type: 'GET',
                    url: '{{route('clients.items')}}',
                    data: $('#update_clients').serialize(),

                    success:function(data){
                        $('.js_html').html(data);
                        //console.log(data);
                    }
                });
            break;
        }
    });
</script>
    </div>

@endsection
