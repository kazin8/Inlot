@extends('layouts.default')

@section('title', 'Регистрация — Inlot.ru')

@section('content')
<!-- content  -->
<section class="content full-height-page">
<div class="container">

<!--title and description-->
<div class="row">
    <div class="col-xs-12 col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
        <h1 class="text-center">Регистрация</h1>
        <p class="text-center offset-text"></p>
        <hr>
    </div>
</div>
<!-- title end -->
<!-- Registration -->
<div class="Registration" data-item="Registration">
    <div class="row">
        <div class="col-xs-12 col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
            <div class="Registration-chose">
                <div class="nav nav-tabs border-none" id="registration" role="tablist">
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-sm-6">
                            <div class="radio" >
                                <label href="#tab1" aria-controls="tab1" role="tab">
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                    Частное лицо
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6 col-sm-6">
                            <div class="radio" >
                                <label href="#tab2" aria-controls="tab2" role="tab">
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option2">
                                    Юридическое лицо
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <!-- Registration form physic`s-->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab1">

                            {!! Form::open(['class' => 'Registration-form', 'autocomplete' => 'off', 'url' => url('/register')]) !!}

                                @include('auth.fields.name', ['label' => 'Имя и Фамилия'])

                                @include('auth.fields.login', ['label' => 'Логин'])

                                @include('auth.fields.email', ['label' => 'E-mail'])

                                @include('auth.fields.phone', ['label' => 'Мобильный номер телефона'])

                                @include('auth.fields.password', ['label' => 'Пароль'])

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                            <p>Регистрируясь, я подтверждаю своё согласие с условиями <a href="#">пользовательского соглашения</a></p>
                                        </div>
                                    </div>
                                </div>

                                @include('auth.fields.layouts.button', ['buttonName' => 'Зарегистрироваться', 'value' => 'individual'])

                            {!! Form::close() !!}

                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab2">
                            <!-- Registration form physic`s END--><!-- Registration form physic`s-->

                            {!! Form::open(['class' => 'Registration-form', 'autocomplete' => 'off', 'url' => url('/register')]) !!}

                                @include('auth.fields.company', ['label' => 'Название компании'])

                                @include('auth.fields.name', ['label' => 'Контактное лицо'])

                                @include('auth.fields.login', ['label' => 'Логин'])

                                @include('auth.fields.email', ['label' => 'E-mail'])

                                @include('auth.fields.phone', ['label' => 'Мобильный номер телефона'])

                                @include('auth.fields.password', ['label' => 'Пароль'])

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                            <p>Регистрируясь, я подтверждаю своё согласие с условиями <a href="#">пользовательского соглашения</a></p>
                                        </div>
                                    </div>
                                </div>

                                @include('auth.fields.layouts.button', ['buttonName' => 'Зарегистрироваться', 'value' => 'entity'])

                            {!! Form::close() !!}

                        </div>
                    </div>
                    <!-- Registration form physic`s END-->
                </div>
            </div>

            <!-- Alternative oAuth-->
            <div class="Registration-alternative">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12">
                        <p class="or text-center"><span>или</span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12 text-center">
                        <div class="Registration-social">
                            <div><a href="#" class="vk"></a></div>
                            <div><a href="#" class="od"></a></div>
                            <div><a href="#" class="fb"></a></div>
                            <div><a href="#" class="tw"></a></div>
                            <div><a href="#" class="mr"></a></div>
                            <div><a href="#" class="gp"></a></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12 text-center">
                        <p><big>Уже зарегистрированы? <a href="{{ url('/login') }}">Войти</a></big></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Alternative oAuth-->
<!-- Registration END -->

</div>
</section>
<!-- content END -->
@endsection
