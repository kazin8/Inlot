<section class="header-lower">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                {{ Form::open(['url' => route('search')]) }}
                    <div class="col-1">
                        <div class="form-group">
                            {{ Form::text('searchQuery', isset($searchQuery) ? $searchQuery : '', ['class' => 'form-control search-input', 'placeholder' => 'Найти...', 'type' => 'search']) }}
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            {{
                            Form::select('category',
                                [
                                    '2' => 'Легковые автомобили',
                                    '3' => 'Запчасти',
                                    '5' => 'Шины',
                                    '6' => 'Диски',
                                    '7' => 'Колеса'
                                ],
                                isset($categoryId) ? $categoryId : null,
                                ['data-item' => 'select-no-search', 'class' => 'form-control category-select', 'placeholder' => 'Все категории']
                            )
                            }}
                        </div>
                    </div>
                    <div class="col-3">
                        {{ Form::button('Найти', ['class' => 'btn btn-info', 'type' => 'submit']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</section>