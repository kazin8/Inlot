@extends('layouts.default')

@section('title', 'Восстановление пароля — Inlot.ru')
<!-- Main Content -->
@section('content')
<!-- content  -->
<section class="content full-height-page">
    <div class="container">

        @if (session('status'))

            @include('auth.includes.send_reset_link_success')

        @else

            <!--title and description-->
            <div class="row">
                <div class="col-xs-12 col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                    <h1 class="text-center">Восстановление пароля</h1>
                    <p class="text-center"><big>Введите ваш Email, и мы вышлем на него новый пароль. Позже его можно будет изменить в личном кабинете.</big></p>
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

                                {!! Form::open(['class' => 'Password-reset-form', 'url' => url('/password/email')]) !!}

                                    {!! csrf_field() !!}

                                    @include('auth.fields.email', ['label' => 'Электронная почта'])

                                    <div class="form-group">
                                        <div class="row">

                                        </div>
                                    </div>

                                    @include('auth.fields.layouts.button', ['buttonName' => 'Сбросить пароль'])

                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 col-sm-12 text-center">
                                            <p><a href="{{ url('/login') }}"><big>← Вернуться к форме входа</big></a></p>
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

        @endif

    </div>
</section>
<!-- content END -->
@endsection
