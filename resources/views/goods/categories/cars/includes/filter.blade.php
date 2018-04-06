<div class="col-xs-12 col-md-3 col-sm-3">
    <nav class="product-item-filter-sidebar">
        <!-- form filter -->
        {{ Form::open(['url' => route('goods.list.filterAndViewPartial', ['slug' => 'cars']), 'class' => 'form-filter', 'id' => 'form_filter']) }}
        <ul>
            <!--Марка-->
            <li>
                <div class="row">
                    <div class="col-xs-12">
                        <p class="product-item-filter-sidebar--title">Марка</p>
                        {{ Form::select('mark', $filters['marks'], null, ['class'=>'form-control select-marks', 'data-item' => 'select', 'placeholder' => 'Выберите марку']) }}
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
            <!--Год выпуска-->
            <li>
                <div class="row">
                    <div class="col-xs-12">
                        <p class="product-item-filter-sidebar--title">Год выпуска</p>

                        <div class="input-group product-item-filter-sidebar--year">
                            <div>
                                <div>
                                    {{ Form::select('dateBegin', $filters['dates'], $filters['dates'], ['class'=>'form-control', 'data-item' => 'select-no-search']) }}
                                </div>
                                <div>&mdash;</div>
                                <div>
                                    {{ Form::select('dateEnd', $filters['dates'], null, ['class'=>'form-control', 'data-item' => 'select-no-search']) }}
                                </div>
                            </div>
                            <span class="input-group-addon">год</span>
                        </div>

                    </div>
                </div>
            </li><!--Год выпуска END-->
            <li class="collapse-option">
                <button class="btn btn-collapse collapsed" type="button" data-toggle="collapse" data-target="#collapse6">
                    <div><p class="product-item-filter-sidebar--title">Тип двигателя</p></div>
                    <div>
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                        <i class="fa fa-angle-up" aria-hidden="true"></i>
                    </div>
                </button>
                <div class="collapse" id="collapse6">
                    <div class="collapse-body full-width-select">
                        <div class="row">
                            <div class="col-xs-12">
                                {{ Form::select('engine', $filters['engines'], null, ['class' => 'form-control', 'data-item' => 'select', 'placeholder' => 'Выберите тип']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="product-item-filter-sidebar--confirm">
            <div>
                <button class="btn btn-info goods-list-filter" type="submit">Показать</button>
            </div>
            <div>
                <button class="btn btn-link" type="button" data-item="reset-filter">сбросить</button>
            </div>
        </div>
        {{ Form::close() }}
    </nav>
</div>