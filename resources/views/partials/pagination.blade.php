@if ($paginationView)
    <div class="pagination-block">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-sm-12">
                {{ Form::open(['url' => $url, 'class' => 'form-pagination']) }}
                    {{ Form::hidden('page', $page, ['class' => 'page-pagination']) }}
                    {{ Form::button('Показать еще ' . $perPage, ['class' => 'btn btn-default btn-block', 'type' => 'submit']) }}
                {{ Form::close() }}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12 col-sm-12">
                <br>
            </div>
        </div>
    </div>
@endif
<div class="row">
    <div class="col-xs-12 col-md-12 col-sm-12">
        <p class="text-center">Показано {{ $curGoodsCount }} товаров из {{ $goodsCount }}</p>
    </div>
</div>