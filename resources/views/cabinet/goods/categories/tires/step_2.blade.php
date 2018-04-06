@extends('layouts.cabinet')

@section('title', 'Личный кабинет — Мои товары — Новый товар — Inlot.ru')

@section('content')
<!-- content  -->
<section class="content">
    <div class="container">
        <!--title and description-->
        <div class="row">
            <div class="col-xs-12 col-md-12 col-sm-12 ">
                <h1>Новый товар</h1>
            </div>
        </div><!-- title end -->
        <!-- Add item -->
        <div class="Add-item">
            <!-- Nav tabs -->
            <div class="row">
                <div class="col-xs-12 col-md-10 col-sm-10">
                    <ul class="Add-item-navigation">
                        <li class="disabled">
                            <a class="btn btn-info">1. Выбор категории</a>
                        </li>
                        <li class="active">
                            <a class="btn btn-info">2. Информация о товаре</a>
                        </li>
                        <li class="disabled">
                            <a class="btn btn-info">3. Цена, доставка и оплата</a>
                        </li>
                        <li class="disabled">
                            <a class="btn btn-info">4. Подтверждение</a>
                        </li>
                    </ul>
                </div>
            </div><!-- Nav tabs END-->
            <!-- Nav tabs content -->
            <div class="row">
                <div class="col-xs-12 col-md-10 col-sm-10">
                    <!-- Tab panes -->
                    <div class="tab-content Add-item-tab-content">
                        <div class="tab-pane active" id="tab2">
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-sm-12">
                                    {!! Form::open(['url' => route('cabinet.goods.update', ['step' => 2, 'goods' => $goods->id]), 'class' => 'SecondStepGoods', 'autocomplete' => 'off']) !!}

                                    {{ method_field('patch') }}

                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                            <h2>Местонахождения товара</h2>
                                        </div>
                                    </div>
                                    <!--Город и регион -->
                                    <div class="row">
                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        <label>Регион</label>
                                                    </div>
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        {{ Form::select('region_id', $data['regions'], $data['region'], ['class'=>'form-control select-regions', 'data-item' => 'select']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        <label>Город</label>
                                                    </div>
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        {{ Form::select('city_id', $data['cities'], $data['city'], ['class'=>'form-control select-cities', 'data-item' => 'select']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--Город и регион END-->

                                    <!--Адресс -->
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        <label>Адрес</label>
                                                    </div>
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        {{ Form::text('address', $data['address'], ['class'=>'form-control', 'placeholder' => 'Введите Ваш адрес']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--Адресс END-->

                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                            <hr>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                            <h2>Характеристики товара</h2>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        <label>Диаметр</label>
                                                    </div>
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        <div class="input-group">
                                                            {{ Form::select('diameter', $data['diameters'], $tire->diameter, ['class'=>'form-control', 'data-item' => 'select', 'placeholder' => 'Выбрать...']) }}
                                                            <span class="input-group-addon">
                                                                дюймов
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        <label>Сезонность</label>
                                                    </div>
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        {{ Form::select('seasonality_id', $data['seasonalities'], $tire->seasonality_id, ['class'=>'form-control', 'data-item' => 'select-no-search', 'placeholder' => 'Выбрать...']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        <label>Ширина профиля</label>
                                                    </div>
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        {{ Form::select('profile_width', $data['profileWidthValues'], $tire->profile_width, ['class'=>'form-control', 'data-item' => 'select-no-search', 'placeholder' => 'Выбрать...']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        <label>Высота профиля</label>
                                                    </div>
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        {{ Form::select('profile_height', $data['profileHeightValues'], $tire->profile_height, ['class'=>'form-control', 'data-item' => 'select-no-search', 'placeholder' => 'Выбрать...']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--Состояние -->
                                    <div class="row">
                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        <label>Состояние</label>
                                                    </div>
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        {{ Form::select('state_id', $data['states'], $tire->state_id, ['class'=>'form-control', 'data-item' => 'select-no-search', 'placeholder' => 'Выбрать...']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--Состояние END-->

                                    <div class="row">
                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        <label>Производитель</label>
                                                    </div>
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        {{ Form::text('producer', $tire->producer, ['class'=>'form-control', 'type' => 'text']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        <label>Модель</label>
                                                    </div>
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        {{ Form::text('model', $tire->model, ['class'=>'form-control', 'type' => 'text']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                            <h2>Фото и видео</h2>
                                        </div>
                                    </div>

                                    <!--Фото и видео -->
                                    <div class="row">
                                        <div class="col-xs-12 col-md-9 col-sm-9">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                                <label>Основное фото</label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12 col-md-4 col-sm-4">
                                                                {{ Form::file('image', ['data-max-file-count' => '1', 'data-url' => route('goodsImage', ['goods' => $goods->id]), 'data-input' => 'file', 'type' => 'file', 'multiple' => 'false', 'class' => 'file-loading form-control', 'accept' => 'image/*']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--Фото и видео END-->
                                    <!--Фото и видео -->
                                    <div class="row">
                                        <div class="col-xs-12 col-md-9 col-sm-9">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        <p class="photo-subtitle">Вы можете прикрепить не более 10-ти фотографий товара</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        {{ Form::file('gallery[]', ['data-max-file-count' => '10', 'data-input' => 'file', 'data-url' => route('goodsGallery', ['goods' => $goods->id]), 'type' => 'file', 'multiple' => 'true', 'class' => 'file-loading form-control', 'accept' => 'image/*']) }}
                                                    </div>
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--Фото и видео END-->

                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                            <hr>
                                        </div>
                                    </div>
                                    <!--Комментарий продавца -->
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        <label>Комментарий продавца</label>
                                                    </div>
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        {{ Form::textarea('comment', $goods->comment, ['class'=>'form-control', 'type' => 'text', 'rows' => '6']) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--Комментарий продавца END-->

                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                            <hr>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-md-1 col-sm-2">
                                            <a href="{{ route('cabinet.goods.add') }}" class="">Назад</a>
                                        </div>
                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                            <button type="submit" class="btn btn-orange btn-block">Далее</button>
                                        </div>
                                    </div>
                                    <!-- удалю это на шаге 3 для общего контент блока сделаю отступ-->
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                            <br>
                                            <br>
                                        </div>
                                    </div><!-- удалю это на шаге 3 для общего контент блока сделаю отступ END-->
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Nav tabs content END-->
        </div><!-- Add item END-->
    </div>
</section>
<!-- content END -->
@endsection