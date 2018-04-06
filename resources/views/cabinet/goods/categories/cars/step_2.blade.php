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
                                                <h2>Характеристики автомобиля</h2>
                                            </div>
                                        </div>
                                        <!--Марка -->
                                        <div class="row">
                                            <div class="col-xs-12 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Марка</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::select('mark_id', $data['marks'], $car->mark_id, ['class'=>'form-control select-marks', 'data-item' => 'select', 'placeholder' => 'Выбрать...']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--Марка END-->

                                        <!--Модель -->
                                        <div class="row">
                                            <div class="col-xs-12 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Модель</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::select('model_id', $data['models'], $car->model_id, ['class'=>'form-control select-models', 'data-item' => 'select', 'placeholder' => 'Выбрать...']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--Модель END-->

                                        <!--Год выпуска -->
                                        <div class="row">
                                            <div class="col-xs-12 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Год выпуска</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::select('date_release_id', $data['dates'], $car->date_release_id, ['class'=>'form-control', 'data-item' => 'select']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--Год выпуска END-->

                                        <!--Пробег -->
                                        <div class="row">
                                            <div class="col-xs-12 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Пробег</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <div class="input-group">
                                                                {{ Form::text('run_visible', $car->run, ['class'=>'form-control', 'placeholder' => 'От 0 до 1 000 000', 'type' => 'text', 'data-item' => 'format']) }}
                                                                {{ Form::hidden('run', $car->run, ['data-item' => 'format-to']) }}
                                                                <span class="input-group-addon">
                                                                    км
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--Пробег END-->

                                        <!--Состояние -->
                                        <div class="row">
                                            <div class="col-xs-12 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Состояние</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::select('state_id', $data['states'], $car->state_id, ['class'=>'form-control', 'data-item' => 'select-no-search']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--Состояние END-->

                                        <!--VIN-номер -->
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-md-12 col-sm-12">
                                                                    <label>VIN-номер</label>
                                                                </div>
                                                                <div class="col-xs-12 col-md-12 col-sm-12">
                                                                    {{ Form::text('vin', $car->vin, ['class'=>'form-control', 'placeholder' => 'JN1WNYD21U0000001']) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                                            <div class="my-tooltip">
                                                                <div>
                                                                    <i class="fa fa-question-circle" data-html="true" data-toggle="tooltip" data-placement="right" title="<div class='tooltip-inner-header'>Не подтвержден. <a href='#''>Подтвердить</a></div><div><small>Чтобы начать продавать товары на inlot.ru необходимо подтвердить номер телефона</small></div>"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--VIN-номер END-->
                                        <!--ПТС и Владельцев по ПТС -->

                                        <div class="row">
                                            <div class="col-xs-12 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>ПТС</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::select('pts_id', $data['ptsList'], $car->pts_id, ['class'=>'form-control', 'data-item' => 'select-no-search']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Владельцев по ПТС</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::select('pts_owner_number_id', $data['ptsOwnerNumberList'], $car->pts_owner_number_id, ['class'=>'form-control', 'data-item' => 'select-no-search']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--ПТС и Владельцев по ПТС END-->

                                        <!--Привод -->
                                        <div class="row">
                                            <div class="col-xs-12 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Привод</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::select('gear_id', $data['gears'], $car->gear_id, ['class'=>'form-control', 'data-item' => 'select-no-search', 'placeholder' => 'Выбрать...']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--Привод END-->

                                        <!--Тип кузова -->
                                        <div class="row">
                                            <div class="col-xs-12 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Тип кузова</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::select('body_id', $data['bodies'], $car->body_id, ['class'=>'form-control', 'data-item' => 'select-no-search', 'placeholder' => 'Выбрать...']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--Тип кузова END-->

                                        <!--Цвет -->
                                        <div class="row">
                                            <div class="col-xs-12 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Цвет</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::select('color_id', $data['colors'], $car->color_id, ['class'=>'form-control', 'data-item' => 'select', 'placeholder' => 'Выбрать...']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--Цвет END-->

                                        <!--Тип двигателя Объем двигателя Мощность -->
                                        <div class="row">
                                            <div class="col-xs-12 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Тип двигателя</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::select('engine_id', $data['engines'], $car->engine_id, ['class'=>'form-control', 'data-item' => 'select-no-search', 'placeholder' => 'Выбрать...']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Объем двигателя</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <div class="input-group">
                                                                {{ Form::text('engine_capacity', $car->engine_capacity, ['class'=>'form-control', 'placeholder' => 'л']) }}
                                                                <span href="#" class="input-group-addon">л</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Мощность</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <div class="input-group">
                                                                {{ Form::text('power_visible', $car->power, ['data-item' => 'format', 'class'=>'form-control', 'placeholder' => 'л.с.']) }}
                                                                {{ Form::hidden('power', $car->power, ['data-item' => 'format-to']) }}
                                                                <span href="#" class="input-group-addon">л.с.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--Тип двигателя Объем двигателя Мощность END-->

                                        <!--Руль -->
                                        <div class="row">
                                            <div class="col-xs-12 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Руль</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::select('rudder_id', $data['rudders'], $car->rudder_id, ['class'=>'form-control', 'data-item' => 'select-no-search']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--Руль END-->

                                        <!--КПП -->
                                        <div class="row">
                                            <div class="col-xs-12 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>КПП</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::select('kpp_id', $data['kppList'], $car->kpp_id, ['class'=>'form-control', 'data-item' => 'select-no-search', 'placeholder' => 'Выбрать...']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!--КПП END-->

                                        <div class="row">
                                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                <hr>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                <h2>Комплектация</h2>
                                            </div>
                                        </div>

                                        <!--Комплектация -->
                                        <div class="row">
                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <p class="checkbox-title"><strong>Экстерьер</strong></p>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('sunroof', $car->sunroof) !!} Люк на крыше
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('tinted_windows', $car->tinted_windows) !!} Тонированные стекла
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('xenon_headlights', $car->xenon_headlights) !!} Ксеноновые фары
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('alloy_wheels', $car->alloy_wheels) !!} Легкоспланые диски
                                                    </label>
                                                </div>

                                                <p class="checkbox-title"><strong>Безопасность</strong></p>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('antilock_system', $car->antilock_system) !!} Антиблокировочная система (ABS)
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('traction_control_system', $car->traction_control_system) !!} Антипробуксовочная система
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('stability_system', $car->stability_system) !!} Система курсовой устойчивости
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('parktronic', $car->parktronic) !!} Парктроник
                                                    </label>
                                                </div>

                                                <p class="checkbox-title"><strong>Подушки безопасности</strong></p>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('airbags', $car::AIRBAGS_NONE, ($car->airbags === $car::AIRBAGS_NONE or !$car->airbags) ?: false) }} отсутствует
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('airbags', $car::AIRBAGS_DRIVER, $car->airbags == $car::AIRBAGS_DRIVER ?: false) }} водителя
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('airbags', $car::AIRBAGS_DRIVER_PASSENGERS, $car->airbags == $car::AIRBAGS_DRIVER_PASSENGERS ?: false) }} водителя и пассажиров
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('airbags', $car::AIRBAGS_FRONT_BACK, $car->airbags == $car::AIRBAGS_FRONT_BACK ?: false) }} передние и боковые
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <p class="checkbox-title"><strong>Салон</strong></p>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('salon', $car::SALON_CLOTH, ($car->salon === $car::SALON_CLOTH or !$car->salon) ?: false) }} ткань
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('salon', $car::SALON_VELOUR, $car->salon == $car::SALON_VELOUR ?: false) }} велюр
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('salon', $car::SALON_SKIN, $car->salon == $car::SALON_SKIN ?: false) }} кожа
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('salon', $car::SALON_COMBO, $car->salon == $car::SALON_COMBO ?: false) }} комбинированный
                                                    </label>
                                                </div>

                                                <p class="checkbox-title"><strong>Цвет салона</strong></p>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('salon_color', $car::SALON_COLOR_DARK, ($car->salon_color === $car::SALON_COLOR_DARK or !$car->salon_color) ?: false) }} темный
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('salon_color', $car::SALON_COLOR_LIGHT, $car->salon_color == $car::SALON_COLOR_LIGHT ?: false) }} светлый
                                                    </label>
                                                </div>
                                                <p class="checkbox-title"><strong>Функциональное оборудование</strong></p>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('on_board_computer', $car->on_board_computer) !!} Бортовой компьютер
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('rain_sensor', $car->rain_sensor) !!} Датчик дождя
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('light_sensor', $car->light_sensor) !!} Датчик света
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('cruise_control', $car->cruise_control) !!} Круиз-контроль
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('navigation_system', $car->navigation_system) !!} Навигационная система
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('mirror_heating', $car->mirror_heating) !!} Обогрев зеркал
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('headlight_washer', $car->headlight_washer) !!} Омыватель фар
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('power_steering', $car->power_steering) !!} Усилитель руля
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('central_locking', $car->central_locking) !!} Центральный замок
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <p class="checkbox-title"><strong>Регулировки</strong></p>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('electric_mirrors', $car->electric_mirrors) !!} Электропривод зеркал
                                                    </label>
                                                </div>

                                                <p class="checkbox-title"><strong>Стеклоподъемники</strong></p>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('windows', $car::WINDOWS_MANUAL, ($car->windows === $car::WINDOWS_MANUAL or !$car->windows) ?: false) }} ручные
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('windows', $car::WINDOWS_ELECTRO_FRONT, $car->windows == $car::WINDOWS_ELECTRO_FRONT ?: false) }} электро передние
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('windows', $car::WINDOWS_ELECTRO_ALL, $car->windows == $car::WINDOWS_ELECTRO_ALL ?: false) }} электро все
                                                    </label>
                                                </div>

                                                <p class="checkbox-title"><strong>Сиденье водителя</strong></p>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('driver_seat', $car::DRIVER_SEAT_MANUAL, ($car->driver_seat === $car::DRIVER_SEAT_MANUAL or !$car->driver_seat) ?: false) }} ручная регулировка
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('driver_seat', $car::DRIVER_SEAT_MANUAL_VERTICAL, $car->driver_seat == $car::DRIVER_SEAT_MANUAL_VERTICAL ?: false) }} ручная регулировка по высоте
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('driver_seat', $car::DRIVER_SEAT_ELECTRO, $car->driver_seat == $car::DRIVER_SEAT_ELECTRO ?: false) }} электро регулировка
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('driver_seat', $car::DRIVER_SEAT_MEMORY, $car->driver_seat == $car::DRIVER_SEAT_MEMORY ?: false) }} с памятью положения
                                                    </label>
                                                </div>

                                                <p class="checkbox-title"><strong>Сиденье пассажира</strong></p>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('passenger_seat', $car::PASSENGER_SEAT_MANUAL, ($car->passenger_seat === $car::PASSENGER_SEAT_MANUAL or !$car->passenger_seat) ?: false) }} ручная регулировка
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('passenger_seat', $car::PASSENGER_SEAT_MANUAL_VERTICAL, $car->passenger_seat == $car::PASSENGER_SEAT_MANUAL_VERTICAL ?: false) }} ручная регулировка по высоте
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('passenger_seat', $car::PASSENGER_SEAT_ELECTRO, $car->passenger_seat == $car::PASSENGER_SEAT_ELECTRO ?: false) }} электро регулировка
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('passenger_seat', $car::PASSENGER_SEAT_MEMORY, $car->passenger_seat == $car::PASSENGER_SEAT_MEMORY ?: false) }} с памятью положения
                                                    </label>
                                                </div>

                                                <p class="checkbox-title"><strong>Регулировка руля</strong></p>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('steering_control', $car::STEERING_CONTROL_NONE, ($car->steering_control === $car::STEERING_CONTROL_NONE or !$car->steering_control) ?: false) }} отсутствует
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('steering_control', $car::STEERING_CONTROL_ONE, $car->steering_control == $car::STEERING_CONTROL_ONE ?: false) }} в одной плоскости
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('steering_control', $car::STEERING_CONTROL_TWO, $car->steering_control == $car::STEERING_CONTROL_TWO ?: false) }} в двух плоскостях
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('steering_control', $car::STEERING_CONTROL_ELECTRO, $car->steering_control == $car::STEERING_CONTROL_ELECTRO ?: false) }} электро регулировка
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <p class="checkbox-title"><strong>Комфорт</strong></p>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('wheel_heating', $car->wheel_heating) !!} Подогрев руля
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('seat_heating', $car->seat_heating) !!} Обогрев сидений
                                                    </label>
                                                </div>

                                                <p class="checkbox-title"><strong>Климат</strong></p>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('climate', $car::CLIMATE_NONE, ($car->climate === $car::CLIMATE_NONE or !$car->climate) ?: false) }} отсутствует
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('climate', $car::CLIMATE_CONDITIONER, $car->climate == $car::CLIMATE_CONDITIONER ?: false) }} кондиционер
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('climate', $car::CLIMATE_ONE_ZONE, $car->climate == $car::CLIMATE_ONE_ZONE ?: false) }} климат-контроль 1-зонный
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('climate', $car::CLIMATE_TWO_ZONE, $car->climate == $car::CLIMATE_TWO_ZONE ?: false) }} климат-контроль 2-зонный
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        {{ Form::radio('climate', $car::CLIMATE_THREE_ZONE, $car->climate == $car::CLIMATE_THREE_ZONE ?: false) }} климат-контроль 3-зонный
                                                    </label>
                                                </div>

                                                <p class="checkbox-title"><strong>Сигнализация</strong></p>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('full_time_alarm', $car->full_time_alarm) !!} Штатная
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('immobilizer', $car->immobilizer) !!} Иммобилайзер
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('feedback', $car->feedback) !!} Обратная связь
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('remote_engine_start', $car->remote_engine_start) !!} Дистанционный запуск двигателя
                                                    </label>
                                                </div>

                                                <p class="checkbox-title"><strong>Мультимедиа</strong></p>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('cd', $car->cd) !!} CD
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        {!! Form::boolean('tv', $car->tv) !!} TV
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        </div><!--Комплектация END-->

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
                                                        <p class="photo-subtitle">Вы можете прикрепить не более 10-ти фотографий автомобиля</p>
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
                                    <!--Фото и видео -->
                                    <div class="row">
                                        <div class="col-xs-12 col-md-9 col-sm-9">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                        <p class="photo-subtitle">Загрузите видеоролик с вашим автомобилем или добавьте ссылку на Youtube. Можно добавить только 1 видео.</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-8 col-sm-8">

                                                            {{ Form::text('video', $goods->video, ['class' => 'form-control', 'placeholder' => 'https://www.youtube.com/watch?v=_0y21cFuUT4', 'aria-describedly' => 'basic-addon1']) }}

                                                    </div>
                                                    <div class="col-xs-12 col-md-4 col-sm-4">
                                                        <!-- MINIMUM IMAGE DIMENSIONS -->
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
                                            <div class="col-xs-12 col-md-12 col-sm-12">
						                        <h2>Шины и диски</h2>
                                            </div>
					                    </div>
					                    <!--Тип шин -->
					                    <div class="row">
                                            <div class="col-xs-12 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <div class="row">
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Тип шин</label>
                                                        </div>
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::select('tyre_id', $data['tyres'], $car->tyre_id, ['class' => 'form-control', 'data-item' => 'select', 'placeholder' => 'Выберите тип']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
					                    </div><!--Тип шин END-->

					                    <!--Левое переднее -->
					                    <div class="row">
                                            <div class="col-xs-12 col-md-3 col-sm-3">
                                                <p class="checkbox-title"><strong>Левое переднее</strong></p>
						                        <div class="form-group">
                                                    <div class="row">
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Глубина профилей</label>
							                            </div>
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <div class="input-group">
								                                {{ Form::text('fl_profile_depth', $car->fl_profile_depth, ['class' => 'form-control']) }}
                                                                <span href="#" class="input-group-addon">мм</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
						                        <div class="form-group">
                                                    <div class="row">
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Дефекты дисков</label>
							                            </div>
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::text('fl_disk_defect', $car->fl_disk_defect, ['class' => 'form-control']) }}
							                            </div>
                                                    </div>
						                        </div>
						                        <div class="form-group">
                                                    <div class="row">
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Дефекты колпаков</label>
							                            </div>
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::text('fl_cap_defect', $car->fl_cap_defect, ['class' => 'form-control']) }}
							                            </div>
                                                    </div>
                                                </div>
						                        <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::file('fl_tyre_image', ['data-max-file-count' => '1', 'data-url' => route('carFlImage', ['car' => $car->id]), 'data-input' => 'file', 'type' => 'file', 'class' => 'file-loading form-control', 'accept' => 'image/*']) }}
							                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-3 col-sm-3">
						                        <p class="checkbox-title"><strong>Правое переднее</strong></p>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Глубина профилей</label>
                                                        </div>
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <div class="input-group">
								                                {{ Form::text('fr_profile_depth', $car->fr_profile_depth, ['class' => 'form-control']) }}
								                                <span href="#" class="input-group-addon">мм</span>
                                                            </div>
							                            </div>
                                                    </div>
						                        </div>
						                        <div class="form-group">
                                                    <div class="row">
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Дефекты дисков</label>
							                            </div>
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::text('fr_disk_defect', $car->fr_disk_defect, ['class' => 'form-control']) }}
                                                        </div>
                                                    </div>
						                        </div>
                                                <div class="form-group">
                                                    <div class="row">
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Дефекты колпаков</label>
							                            </div>
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::text('fr_cap_defect', $car->fr_cap_defect, ['class' => 'form-control']) }}
                                                        </div>
                                                    </div>
						                        </div>
						                        <div class="form-group">
                                                    <div class="row">
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::file('fr_tyre_image', ['data-max-file-count' => '1', 'data-url' => route('carFrImage', ['car' => $car->id]), 'data-input' => 'file', 'type' => 'file', 'class' => 'file-loading form-control', 'accept' => 'image/*']) }}
                                                        </div>
                                                    </div>
						                        </div>
                                            </div>
                                            <div class="col-xs-12 col-md-3 col-sm-3">
						                        <p class="checkbox-title"><strong>Левое заднее</strong></p>
						                        <div class="form-group">
                                                    <div class="row">
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Глубина профилей</label>
							                            </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <div class="input-group">
                                                                {{ Form::text('bl_profile_depth', $car->bl_profile_depth, ['class' => 'form-control']) }}
								                                <span href="#" class="input-group-addon">мм</span>
                                                            </div>
							                            </div>
                                                    </div>
						                        </div>
                                                <div class="form-group">
                                                    <div class="row">
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Дефекты дисков</label>
							                            </div>
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::text('bl_disk_defect', $car->bl_disk_defect, ['class' => 'form-control']) }}
							                            </div>
                                                    </div>
						                        </div>
						                        <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Дефекты колпаков</label>
							                            </div>
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::text('bl_cap_defect', $car->bl_cap_defect, ['class' => 'form-control']) }}
							                            </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
							                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::file('bl_tyre_image', ['data-max-file-count' => '1', 'data-input' => 'file', 'data-url' => route('carBlImage', ['car' => $car->id]), 'type' => 'file', 'class' => 'file-loading form-control', 'accept' => 'image/*']) }}
							                            </div>
                                                    </div>
						                        </div>
                                            </div>
                                            <div class="col-xs-12 col-md-3 col-sm-3">
						                        <p class="checkbox-title"><strong>Правое заднее</strong></p>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <label>Глубина профилей</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <div class="input-group">
                                                                {{ Form::text('br_profile_depth', $car->br_profile_depth, ['class' => 'form-control']) }}
                                                                <span href="#" class="input-group-addon">мм</span>
					                                		</div>
                                                        </div>
							                        </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
								                            <label>Дефекты дисков</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::text('br_disk_defect', $car->br_disk_defect, ['class' => 'form-control']) }}
                                                        </div>
							                        </div>
                                                </div>
                                                <div class="form-group">
							                        <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
								                            <label>Дефекты колпаков</label>
                                                        </div>
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::text('br_cap_defect', $car->br_cap_defect, ['class' => 'form-control']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
							                        <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            {{ Form::file('br_tyre_image', ['data-max-file-count' => '1', 'data-input' => 'file', 'data-url' => route('carBrImage', ['car' => $car->id]), 'type' => 'file', 'class' => 'file-loading form-control', 'accept' => 'image/*']) }}
                                                        </div>
							                        </div>
                                                </div>
						                    </div>
                                        </div><!--Левое переднее END-->
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