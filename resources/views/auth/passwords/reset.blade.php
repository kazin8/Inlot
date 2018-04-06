@extends('layouts.default')

@section('title', 'Восстановление пароля - Inlot.ru')

@section('content')
<!-- content  -->
<section class="content full-height-page">
    <div class="container">

        <!--title and description-->
        <div class="row">
            <div class="col-xs-12 col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                <h1 class="text-center">Новый пароль</h1>
                <p class="text-center"><big>Придумайте новый пароль</big></p>
                <hr>
            </div>
        </div>
        <!-- title end -->

        <!-- Registration -->
        <div class="Registration" data-item="Registration">
            <div class="row">
                <div class="col-xs-12 col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-sm-12">
                            <!-- Registration form physic`s-->

                            {!! Form::open(['class' => 'Password-reset-form', 'url' => url('/password/reset')]) !!}

                                {!! csrf_field() !!}

                                {!! Form::hidden('token', $token) !!}

                                {!! Form::hidden('email', $email) !!}

                                @include('auth.fields.password', ['label' => 'Пароль'])

                                @include('auth.fields.password_confirmation', ['label' => 'Повторите пароль'])

                                <div class="form-group">
                                    <div class="row">

                                    </div>
                                </div>

                                @include('auth.fields.layouts.button', ['buttonName' => 'Задать новый пароль и войти'])

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
