@extends('layouts/errors')

@section('title', 'Ошибка 404! Страница не найдена — Торговая площадка Inlot.ru')

@section('content')
    <!-- sticky -->
    <div class="sticky-page Error-page">
        <div class="Error-page-content">

            <div>
                <div>
                    <img src="/assets/img/logo.png" alt="">
                </div>
                <div>
                    <h1>Страница не найдена</h1>
                    <p>
                        Что-то пошло не так.Неправильно набран адрес,<br>
                        или такой страницы на сайте больше не существует.
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