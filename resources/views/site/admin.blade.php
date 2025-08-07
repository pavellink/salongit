@extends('app_index')

@section('content')
    <style>
        body {
            background: linear-gradient(-45deg, #23a6d5, #e73c7e, #ee7752);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

    </style>
    <div class="d-flex flex-column justify-content-center w-100 h-100">

        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="container" style="text-align: center">
            <h1 class="fw-light text-white m-0">ОРХИДЕЯ: АДМИНИСТРАТОР</h1>
            <div class="btn-group my-4">
                <a href="/cabinet" class="btn btn-outline-light" aria-current="page">Войти</a>
            </div>
            <a href="https://manuel.pinto.dev" class="text-decoration-none">
                <h6 class="fw-light text-white m-0">— создаем красоту —</h6>
            </a>
            </div>
        </div>
    </div>
@endsection
