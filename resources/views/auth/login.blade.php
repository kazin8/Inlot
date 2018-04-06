@extends('layouts.default')

@section('title', 'Авторизация — Inlot.ru')

@section('content')
<!-- content  -->
<section class="content full-height-page">
    <div class="container">

        <!--title and description-->
        <div class="row">
            <div class="col-xs-12 col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                <h1 class="text-center">Вход в inlot.ru</h1>
                <p class="text-center"><big>Нет аккаунта в inlot.ru? <a href="{{ url('/register') }}">Зарегистрироваться</a></big></p>
                <hr>
            </div>
        </div>
        <!-- title end -->

        @if (count($errors))

            @include('auth.includes.errors')

        @endif

        <!-- Registration -->
        <div class="Registration" data-item="Registration">
            <div class="row">
                <div class="col-xs-12 col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <!-- Registration form physic`s-->

                            {!! Form::open(['class' => 'Login-form', 'url' => url('/login')]) !!}

                                @include('auth.fields.login', ['label' => 'Электронная почта или логин'])

                                @include('auth.fields.password', ['label' => 'Пароль'])

                                <div class="form-group">
                                    <div class="row">

                                    </div>
                                </div>

                                @include('auth.fields.layouts.button', ['buttonName' => 'Войти'])

                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-sm-12 text-center">
                                        <p><a href="{{ url('/password/reset') }}"><big>Забыли пароль?</big></a></p>
                                    </div>
                                </div>

                            {!! Form::close() !!}

                            <!-- Registration form physic`s END-->
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Registration END -->

    </div>
</section>
<!-- content END -->
@endsection
