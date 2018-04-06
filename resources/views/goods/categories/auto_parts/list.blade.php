@extends('layouts.home')

@section('title', 'Запчасти для иномарок, новые и б/у автозапчасти, продажа запчастей на торговой площадке Inlot.ru')
@section('d', 'Новые и б/у автозапчасти на торговой площадке Inlot.ru. Оптовая и розничная продажа по отличной цене.')

@section('content')
<!-- content  -->
<section class="content">
    <div class="container">
    @include('includes.breadcrumbs')
        <!--title and description-->
        <div class="row">

            @include('goods.categories.auto_parts.includes.filter')

            <div class="col-xs-12 col-md-9 col-sm-9">
                <div class="Settings-header">
                    <h1>Товары в продаже</h1>
                </div>
                <div class="product-item-filter">
                    <div class="product-item-filter-navigation">
                        <ul>
                            <li class="active"><div></div><a href="#">Все товары</a></li>
                            <!--<li><div></div><a href="#">Аукционы</a></li>
                            <li><div></div><a href="#">Купить сейчас</a></li>-->
                        </ul>
                    </div>
                    <div class="product-item-filter-search && custom">
                        <div>
                            <form action="">
                                <div class="form-group">
                                    <select name="" class="sort-list" data-item="select-no-search">
                                        <option value="price_asc">увеличению цены</option>
                                        <option value="price_desc">уменьшению цены</option>
                                        <option value="name_asc">названию</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div>
                            <div>Вид каталога</div>
                            <div><a href class="view-list" data-view="tile"><i class="fa fa-th-large" aria-hidden="true"></i></a></div>
                            <div><a href class="active view-list" data-view="row"><i class="fa fa-th-list" aria-hidden="true"></i></a></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div id="result-list" class="Product-item-grid">
                        @include('goods.categories.auto_parts.partials.list_row')
                    </div>
                </div>

                @if (count($autoParts))
                    <div id="pagination-block">
                        {!! $paginationBlock !!}
                    </div>
                @endif

            </div>
        </div><!-- products vertical END-->

    </div>
    </div><!-- title end -->
    </div>
</section>
<!-- content END -->
@endsection