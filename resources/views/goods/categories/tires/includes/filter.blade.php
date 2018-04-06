<div class="col-xs-12 col-md-3 col-sm-3">
    {{ Form::open(['url' => route('goods.list.filterAndViewPartial', ['slug' => 'tires']), 'class' => 'form-filter', 'id' => 'form_filter']) }}
    <nav class="product-item-filter-sidebar new">
        <!-- form filter -->

        <ul>
            <li>
                <div class="row">
                    <div class="col-xs-12">
                        <p class=""><strong>Подбор шин</strong></p>
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-xs-12">
                        <p class="product-item-filter-sidebar--title">Диаметр, дюймов</p>
                        {{ Form::select('diameter', $filters['diameters'], null, ['class'=>'form-control', 'data-item' => 'select-tags', 'placeholder' => 'Выберите диаметр']) }}
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-xs-12">
                        <p class="product-item-filter-sidebar--title">Сезонность</p>
                        {{ Form::select('seasonality', $filters['seasonalities'], null, ['class'=>'form-control', 'data-item' => 'select-tags', 'placeholder' => 'Выберите сезонность']) }}
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-xs-12">
                        <p class="product-item-filter-sidebar--title">Ширина профиля</p>
                        {{ Form::select('profileWidth', $filters['profileWidthList'], null, ['class'=>'form-control', 'data-item' => 'select-tags', 'placeholder' => 'Выберите ширину профиля']) }}
                    </div>
                </div>
            </li>
            <li>
                <div class="row">
                    <div class="col-xs-12">
                        <p class="product-item-filter-sidebar--title">Высота профиля</p>
                        {{ Form::select('profileHeight', $filters['profileHeightList'], null, ['class'=>'form-control', 'data-item' => 'select-tags', 'placeholder' => 'Выберите высоту профиля']) }}
                    </div>
                </div>
            </li>
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