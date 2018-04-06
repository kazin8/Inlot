@extends('layouts/errors')

@section('title', 'Ошибка 500! Что-то пошло не так — Торговая площадка Inlot.ru')

@section('content')
    <!-- sticky -->
    <div class="sticky-page Error-page">
        <div class="Error-page-content">

            <div>
                <div>
                    <img src="/assets/img/logo.png" alt="">
                </div>
                <div>
                    <h1>На странице возникла ошибка</h1>
                    <p>
                        Что-то пошло не так. Мы честно исправим это<br>
                        совсем скоро.
                    </p>
                    <a href="/">Перейти на главную</a>
                </div>
            </div>
            <div>
                <div>
                    <img src="/assets/img/404/item-1.jpg" alt="" class="full-width">
                </div>
            </div>
        </div>
    </div><!-- sticky END-->
@endsection