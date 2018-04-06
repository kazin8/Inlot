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
                        <li class="active">
                            <a class="btn btn-info">1. Выбор категории</a>
                        </li>
                        <li class="disabled">
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
                        <div class="tab-pane active" id="tab1">
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-sm-12">
                                    <h2>Выберите категорию</h2>
                                </div>
                            </div>
                            {{ Form::open(['url' => route('cabinet.goods.store'), 'data-item' => 'add-item-stage-1']) }}
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-sm-12">
                                    <div class="Add-item-list-block">

                                        <div data-item="category">
                                            <ul>
                                                <li><p>Категория</p></li>
                                                <li>
                                                    <input name="category" value="0" type="radio" id="input1">
                                                    <label class="btn btn-default" for="input1">
                                                        Транспорт и запчасти
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                        <!--sub category-->
                                        <div data-item="subcategory" class="hidden">
                                            <ul>
                                                <li><p>Транспорт и запчасти</p></li>
                                                <li>
                                                    <input name="subcategory" value="cars" type="radio" id="input2">
                                                    <label class="btn btn-default" for="input2">
                                                        Легковые автомобили
                                                    </label>
                                                </li>
                                                <li>
                                                    <input name="subcategory" value="auto_parts" type="radio" id="input3">
                                                    <label class="btn btn-default" for="input3">
                                                        Запчасти
                                                    </label>
                                                </li>
                                                <li>
                                                    <input name="subcategory" value="tires" type="radio" id="input4">
                                                    <label class="btn btn-default" for="input4">
                                                        Шины
                                                    </label>
                                                </li>
                                                <li>
                                                    <input name="subcategory" value="rims" type="radio" id="input5">
                                                    <label class="btn btn-default" for="input5">
                                                        Диски
                                                    </label>
                                                </li>
                                                <li>
                                                    <input name="subcategory" value="wheels" type="radio" id="input6">
                                                    <label class="btn btn-default" for="input6">
                                                        Колеса
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-md-12 col-sm-12">
                                    {{ Form::button('Далее', ['class' => 'btn btn-orange col-sm-4 col-md-4', 'type' => 'submit']) }}
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div><!-- Nav tabs content END-->
        </div><!-- Add item END-->

    </div>
</section>
<!-- content END -->
@endsection