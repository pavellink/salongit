@extends('app')
@section('content')
    @widget('aside', ['page' => 4])
    <div class="page_content">
        <div class="main_block">
            <h1 class="page_title">Логирование</h1>
        </div>
        <style>
            table {border-collapse: collapse;width: 100%;font-size: 16px;background: #fff;}
            table, th {border-bottom: 1px solid #ddd;}
            tr{border-bottom: 1px solid #ddd;}
            tr:last-child{border-bottom: 0}
            th, td{padding: 10px 20px}
            thead{border-collapse: separate;}
            thead th{padding: 15px 20px;}
            thead select{border: 1px solid #ddd;width: 100%;border-radius: 10px;padding: 8px 16px}
            .td_head_btn button{padding: 10px 20px;border-radius: 10px}
            tbody{border-collapse: separate;}
            td:first-child{padding-left: 20px}
            td:last-child{padding-right: 20px}
            .td_id{border-right: 1px solid #ddd;width: 75px;text-align: center}
            .td_name{border-right: 1px solid #ddd}
            .td_phone{border-right: 1px solid #ddd}
            .td_acts{width: 150px;text-align: right;white-space: nowrap}
            .td_acts button{width: 100%;background: #bbb;color: #fff;padding: 8px 16px;border-radius: 10px;}
            th input{width: 100%;padding: 10px 16px;border: 1px solid #ddd;border-radius: 10px}
            tr:nth-child(2n) {background:#f8fafc;}
            .btn_show_phone{display: table;background: #ffffff;border-radius: 25px;color: #222;padding: 2px 8px;border: 1px solid #bbb;}

            .td_user{overflow: hidden;width: 175px;}
            .td_act_type{width: 175px;}
            .td_user span{display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;}
            .td_user select{width: 100%}
        </style>

        <form action="" id="formlog" method="GET">

        </form>
        <div class="main_block" style="padding: 0">
            <table>
                <thead>
                    <tr>
                        <th class="td_user">Пользователь</th>
                        <th class="td_act_type">Запрос</th>
                        <th class="">Сообщение</th>
                        <th class="">Когда</th>
                    </tr>
                </thead>
                <thead>
                <tr>
                    <th class="td_user">
                        <select class="js_keyup" form="formlog" name="user_id">
                            <option value=""></option>
                            @forelse($users ?? [] as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @empty
                            @endforelse
                        </select>
                    </th>
                    <th class="td_act_type">
                        <select class="js_keyup" form="formlog" name="act_id">
                            <option value=""></option>
                            @forelse($acts ?? [] as $act)
                                <option value="{{$act->id}}">{{$act->title}}</option>
                            @empty
                            @endforelse
                        </select>
                    </th>
                    <th class="td_find">
                        <input form="formlog" class="js_keyup" name="find" type="text" autocomplete="off" value="">
                    </th>
                    <th class="td_head_btn">
                        <button form="formlog" type="submit">Поиск</button>
                    </th>
                </tr>
                </thead>
                <tbody class="js_html">
                @include('log.items')
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
                            url: '{{route('log.items')}}',
                            data: $('#formlog').serialize(),

                            success:function(data){
                                $('.js_html').html(data);
                                console.log(data);
                            }
                        });
                        break;
                }
            });
            $('.js_keyup').on('change',function(I) {
                switch(I.keyCode) {
                    case 13:
                    case 27:
                    case 38:
                    case 40:
                        break;
                    default:
                        $.ajax({
                            type: 'GET',
                            url: '{{route('log.items')}}',
                            data: $('#formlog').serialize(),

                            success:function(data){
                                $('.js_html').html(data);
                                console.log(data);
                            }
                        });
                        break;
                }
            });
        </script>
    </div>

@endsection
