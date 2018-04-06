<div class="col-xs-12 col-md-3 col-sm-3">
    {{ Form::open(['url' => route('goods.list.filterAndViewPartial', ['slug' => 'auto-parts']), 'class' => 'form-filter', 'id' => 'form_filter']) }}
    <nav class="product-item-filter-sidebar new">
        <ul>
            <li>
                <div class="row">
                    <div class="col-xs-12">
                        <p class=""><strong>Поиск по номеру детали</strong></p>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-xs-12">
                        {{ Form::text('originalNumber', null, ['class'=>'form-control']) }}
                    </div>
                </div>
            </li>
        </ul>
    </nav>

    <nav class="product-item-filter-sidebar new">
        <!-- form filter -->

        <ul>
            <li>
                <div class="row">
                    <div class="col-xs-12">
                        <p class=""><strong>Подбор запчастей</strong></p>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-xs-12">
                        <p class="product-item-filter-sidebar--title">Вид запчасти</p>
                        {{ Form::select('kind', $filters['kinds'], null, ['class'=>'form-control', 'data-item' => 'select-tags', 'placeholder' => 'Выберите вид']) }}
                    </div>
                </div>
            </li>
            <!--Марка-->
            <li>
                <div class="row">
                    <div class="col-xs-12">
                        <p class="product-item-filter-sidebar--title">Марка</p>
                        {{ Form::select('marks[]', $filters['marks'], null, ['class'=>'form-control select-marks', 'data-item' => 'select', 'multiple' => 'true']) }}
                    </div>
                </div>
            </li><!--Марка END-->
            <!--Модель-->
            <li>
                <div class="row">
                    <div class="col-xs-12">
                        <p class="product-item-filter-sidebar--title">Модель</p>
                        {{ Form::select('models[]', [], null, ['class'=>'form-control select-models', 'data-item' => 'select-tags', 'multiple' => 'true']) }}
                    </div>
                </div>
            </li><!--Модель END-->
            <li>
                <div class="row">
                    <div class="col-xs-12">
                        <p class="product-item-filter-sidebar--title">Состояние</p>
                        {{ Form::select('state', $filters['states'], null, ['class'=>'form-control', 'data-item' => 'select-tags', 'placeholder' => 'Выберите состояние']) }}
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="product-item-filter-sidebar--confirm">
                            <div>
                                <button class="btn btn-info goods-list-filter" type="submit">Показать</button>
                            </div>
                            <div>
                                <button class="btn btn-link" type="button" data-item="reset-filter">сбросить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
    {{ Form::close() }}
</div>