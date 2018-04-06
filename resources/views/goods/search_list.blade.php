@extends('layouts/site')

@section('title')
    {{$searchQuery}} — Торговая площадка Inlot.ru
@endsection

@section('content')
<!-- content  -->
<section class="content">
    <div class="container">

        <!--title and description-->
        <div class="row">
            <div class="col-xs-12 col-md-3 col-sm-3">
                @if (count($newGoods))
                    <div class="my-navigation-title">
                        <p><strong>Новые товары</strong></p>
                    </div>
                    @foreach ($newGoods as $product)
                        <div class="Product-item bordered border-radius">
                            <a href="{{ route('goods.item', ['goods' => $product->id]) }}" class="Product-item-link"></a>
                            <div class="Product-item-header">
                                <a href="{{ route('goods.item', ['goods' => $product->id]) }}"><img src="{{ $product->imagePath }}" alt=""></a>
                            </div>
                            <div class="Product-item-content">
                                <p class="name"><a href="{{ route('goods.item', ['goods' => $product->id]) }}">{{ $product->name }}</a></p>
                                <p class="price">{{ $product->priceFormat }} ₽</p>
                                <div class="lot">
                                    <div><p>купить сейчас</p></div>
                                </div>
                            </div>
                            <div class="Product-item-footer">
                                @include('partials/' . $product->category->code . '/add_info', ['unit' => $product->unit])
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-xs-12 col-md-9 col-sm-9">
            <div class="Settings-header">
                <h1>Результаты поиска</h1>
            </div>

            <!-- результаты поиска\сортировки-->
            <div class="product-item-filter--result-search upper">
                <p>Найдено <strong>{{ $goodsCount }}</strong> товаров</p>
            </div><!-- результаты поиска\сортировки END-->

            <div class="product-item-filter">
                <div class="product-item-filter-navigation">
                    <ul>
                        <li class="active"><div></div><a href="#">Все товары</a></li>
                        <li><div></div><a href="#">Аукционы</a></li>
                        <li><div></div><a href="#">Купить сейчас</a></li>
                    </ul>
                </div>
                <div class="product-item-filter-search && custom">
                    <div>
                        {{ Form::open(['url' => route('goods.searchList.filter'), 'class' => 'form-filter']) }}
                            <div class="form-group">
                                <select class="sort-list" data-item="select-no-search">
                                    <option value="price_asc">увеличению цены</option>
                                    <option value="price_desc">уменьшению цены</option>
                                    <option value="name_asc">названию</option>
                                </select>
                            </div>
                        {{ Form::close() }}
                    </div>
                    <div>
                        <div>Вид каталога</div>
                        <div><a href class="view-list" data-view="tile"><i class="fa fa-th-large" aria-hidden="true"></i></a></div>
                        <div><a href class="active view-list" data-view="row"><i class="fa fa-th-list" aria-hidden="true"></i></a></div>
                    </div>
                </div>
            </div>

            <!-- products vertical -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div id="result-list" class="Product-item-grid">
                        @include('partials.list_row', ['products' => $goods])
                    </div>
                </div>
            </div><!-- products vertical END-->

            @if (count($goods))
                <div id="pagination-block">
                    {!! $paginationBlock !!}
                </div>
            @endif

            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12">
                    <br>
                </div>
            </div>
            </div>
        </div><!-- title end -->
    </div>
</section>
<!-- content END -->
@endsection