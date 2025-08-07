@extends('app_index')
@section('content')
    <style>
        .cabinet_container{width: 100%;max-width: 800px;margin: 40px auto}
        .cabinet_title{font-size: 34px;font-weight: 900;}
        .cabinet_edit{margin: 30px 0}
        .cabinet_edit_item{margin-bottom: 20px}
        .cabinet_edit_label{}
        .cabinet_edit_input{padding: 15px 20px;border-radius: 8px;border: 1px solid #ddd;width: 100%;}
        .cabinet_edit_save{padding: 15px 25px;background: #e73c7e;display: table;color: #fff;font-size: 16px;font-weight: 600;border-radius: 8px;border: none;margin-top: 40px;}
    </style>
    <div class="cabinet_container">

        <div class="cabinet_title">Давайте сверим ваши данные</div>
        <div class="cabinet_edit">
            <form action="{{route('verifi.user.confirm')}}" method="POST" class="js_form_user_confirm">
                @csrf
                <div class="cabinet_edit_item">
                    <div class="cabinet_edit_label">Имя</div>
                    <input type="text" class="cabinet_edit_input" name="name" value="{{$user->name}}">
                </div>
                <div class="cabinet_edit_item">
                    <div class="cabinet_edit_label">Фамилия</div>
                    <input type="text" class="cabinet_edit_input" name="name2" value="{{$user->name2}}">
                </div>
                <div class="cabinet_edit_item">
                    <div class="cabinet_edit_label">Дата рождения (персональные скидки)</div>
                    <input type="date" class="cabinet_edit_input" name="dob" value="{{$user->dob}}">
                </div>
                <div class="cabinet_edit_item">
                    <div class="cabinet_edit_label">Телефон</div>
                    <input type="text" class="cabinet_edit_input js_mask_phone js_phone"  {{$user->phone_verified_at ? 'disabled' : null}} value="{{$user->phone}}">

                    @if($user->phone_verified_at)
                    <div class="cabinet_edit_subinput" style="color: #59b719;font-weight: 600;margin-top: 4px;"><i class="far fa-check-circle"></i> Телефон подтвержден</div>
                    @else
                    <div class="cabinet_edit_subinput js_verifi" style="color: #2572fa;font-weight: 500;margin-top: 4px;">Подтвердить телефон</div>
                    <div class="cabinet_edit_subinput js_confirm_phone" style="color: #59b719;font-weight: 600;margin-top: 4px;display: none"><i class="far fa-check-circle"></i> Телефон подтвержден</div>
                    @endif
                </div>
                <div class="cabinet_edit_item">
                    <div class="cabinet_edit_label">Почта</div>
                    <input type="text" class="cabinet_edit_input" name="email" value="{{$user->email_null ? null : $user->email}}">
                </div>
                <button type="submit" class="cabinet_edit_save">Подтвердить</button>
            </form>
        </div>
    </div>
    <script>
        $('.js_verifi').on('click', function (){
            let phone = $('.js_phone').val();
            $.post('{{route('verifi.phone')}}', {phone: phone, _token: '{!! csrf_token() !!}'}, function(data){
                if(data.error){
                    alert(data.error);
                } else {
                    $('.app_modal').html(data);
                }
            });
        });

        $('.js_mask_phone').mask("+7 (999) 999-9999");
    </script>
@endsection
