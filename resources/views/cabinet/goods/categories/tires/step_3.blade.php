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
                        <li class="disabled">
                            <a class="btn btn-info">2. Информация о товаре</a>
                        </li>
                        <li class="active">
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
                <div class="col-xs-12 col-md-12 col-sm-12">

                    <div class="row">
                        <!-- left side -->
                        <div class="col-xs-12 col-md-7 col-sm-7">
                            <!-- Tab panes -->
                            <div class="tab-content Add-item-tab-content">
                                <div class="tab-pane active" id="tab3">
                                    <ul class="Add-item-navigation-inner">
                                    </ul>
                                    <div class="tab-content Add-item-tab-content">
                                        <div class="tab-pane active" id="tabInner1">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12 col-sm-12">
                                                    {!! Form::open(['url' => route('cabinet.goods.edit', ['step' => 3, 'goods' => $goods->id]), 'method' => 'PATCH', 'class' => 'ThirdStepGoods', 'autocomplete' => 'off']) !!}
                                                    <!--Цена -->
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-4 col-sm-4">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                                        <label>Цена</label>
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12 col-sm-12">

                                                                        <div class="input-group">
                                                                            {{ Form::text('price_visible', $goods->price, ['class'=>'form-control', 'placeholder' => 'Цена', 'data-item' => 'format', 'data-calc' => 'price']) }}
                                                                            {{ Form::hidden('price', $goods->price, ['data-item' => 'format-to']) }}
                                                                            <span class="input-group-addon">₽</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12 col-md-3 col-sm-3">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                                        <label class="op-0">None</label>
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">за</span>
                                                                            {{ Form::select('quantum', $goods->quantumList, $goods->quantum ?: 1, ['class' => 'form-control', 'data-item' => 'complectation']) }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!--Цена END-->

                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-4 col-sm-4">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                                        <label>Наличие</label>
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                                        <div class="input-group">
                                                                            {{ Form::text('count_visible', $goods->count ?: 1, ['class'=>'form-control fix-width', 'placeholder' => 'Например, 4', 'data-item' => 'format', 'data-calc' => 'count']) }}
                                                                            {{ Form::hidden('count', $goods->count ?: 1, ['data-item' => 'format-to']) }}
                                                                            <span class="input-group-addon">шт.</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <div class="form-group reset-margin">
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                                        <div class="Add-item-tab-content-complictation hidden">
                                                                            <div><p>Стоимость комплекта</p></div>
                                                                            <div><p class="price"><span>8 000</span> ₽</p></div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <!--Информация о доставке -->
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                                        <label>Информация о доставке</label>
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                                        {{ Form::textarea('delivery_info', $goods->delivery_info, ['class'=>'form-control', 'rows' => '6']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!--Информация о доставке END-->
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <hr>
                                                        </div>
                                                    </div>

                                                    <!--Требования к оплате -->
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                                        <label>Требования к оплате</label>
                                                                    </div>
                                                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                                                        {{ Form::textarea('payment_requirement', $goods->payment_requirement, ['class'=>'form-control', 'rows' => '6']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!--Требования к оплате END-->
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-1 col-sm-2">
                                                            <a href="{{ route('cabinet.goods.edit', ['step' => 2, 'goods' => $goods->id]) }}" class="">Назад</a>

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
                            </div>
                        </div><!-- left side END-->
                        <!-- right side -->
                        <!--<div class="col-xs-12 col-md-5 col-sm-5">
                            <div class="B-info">
                                <p>Метафора, за счет использования параллелизмов и повторов на разных языковых уровнях, традиционно отталкивает стиль.</p>
                                <p>Вопрос о популярности произведений того или иного автора относится к сфере культурологии, однако заимствование аннигилирует</p>
                                <p>былинный лирический субъект, что связано со смысловыми оттенками, логическим выделением или с <a href="#">синтаксической омонимией</a>.</p>
                            </div>
                        </div>--><!-- right side END-->

                    </div>

                </div>
            </div><!-- Nav tabs content END-->
        </div><!-- Add item END-->

    </div>
</section>
<!-- content END -->
@endsection