@extends('layouts.cabinet')

@section('title', 'Личный кабинет — Настройки — Inlot.ru')

@section('content')
<!-- content  -->
<section class="content">
    <div class="container">
        <!--title and description-->
        <div class="row">

            @include('includes.left_menu')

            <div class="col-xs-12 col-md-9 col-sm-9">
                <div class="Settings-header">
                    <h1>Настройки</h1>
                </div>
                <div class="Settings-content">
                    <div>
                        <!-- Nav tabs -->
                        <ul class="my-navigation-tablink" role="tablist">
                            <li class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Общие</a></li>
                            <li><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Уведомления</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                        <h2>Смена пароля</h2>
                                        <p class="gray">Введите свой текущий пароль, новый пароль, и повторите ввод нового пароля, чтобы исключить возможность опечатки.</p>
                                    </div>
                                </div>

                                {!! Form::open(['url' => route('cabinet.settings.password.change'), 'class' => 'ChangePassword', 'autocomplete' => 'off']) !!}

                                    @include('cabinet.settings.form_password')

                                {!! Form::close() !!}

                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                        <hr>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                        <h2>Электронная почта</h2>
                                        <p class="gray current-email">Текущий e-mail</p>
                                        <p><big>{{ Auth::user()->email }}</big></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                        {!! Form::open(['url' => route('cabinet.settings.email.change'), 'class' => 'ChangeEmail', 'autocomplete' => 'off']) !!}

                                            @include('cabinet.settings.form_email')

                                        {!! Form::close() !!}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                        <hr>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                        <h2>Логин</h2>
                                        <p class="gray current-email">Текущий логин</p>
                                        <p><big>{{ Auth::user()->login }}</big></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                        {!! Form::open(['url' => route('cabinet.settings.login.change'), 'class' => 'ChangeLogin', 'autocomplete' => 'off']) !!}

                                            @include('cabinet.settings.form_login')

                                        {!! Form::close() !!}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                        <hr>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                        <h2>Удаление учетной записи</h2>
                                        <p class="gray current-email">Если вы хотите навсегда удалить свою учётную запись и все свои объявления, то нажмите на кнопку «Перейти к удалению учётной записи»</p>
                                        <br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-4 col-sm-4">
                                        {!! Form::open(['url' => route('cabinet.settings.account.delete')]) !!}

                                            {!! method_field('delete') !!}

                                            {!! Form::button('Удалить учетную запись', ['class' => 'btn btn-gray btn-block', 'type' => 'submit']) !!}

                                        {!! Form::close() !!}
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tab2">
                                <form class="Settings" autocomplete="off">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                            <h2>Присылать на электронную почту</h2>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> Новости inlot.ru
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> Уведомления
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                            <button type="submit" class="btn btn-orange btn-block" name="from" value="">Сохранить</button>
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                            <button type="button" class="btn btn-info btn-block" name="from" value="">Стать продавцом</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- title end -->
    </div>
</section>
<!-- content END -->

@endsection