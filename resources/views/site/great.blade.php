@extends('app_index')
@section('content')
    <div class="container-lg">
        <div class="block">
            <div class="block_title">Ваш заказ №{{$item->id}} от {{Helper::datetime($item->created_at)}} успешно создан.</div>
            <div class="block_descr"><p>Наши специалисты скоро с вами свяжутся!</p></div>
        </div>
    </div>
@endsection
