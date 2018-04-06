@extends('layouts.home')

@section('title', 'Покупка и продажа автомобилей, запчастей, шин и дисков на торговой площадке inlot.ru')
@section('d', 'Покупка и продажа автомобилей: купить авто новый или с пробегом. Купить, продать запчасти, шины и диски по выгодной цене на торговой площадке Inlot.ru')

@section('content')
<!-- content  -->
<section class="content">
    <div class="container">
        <!--<div class="row">
            <div class="col-xs-12 col-sm-9 col-md-9">
                <div class="Owl-main" data-item="slider-main">
                    <div><a href="#"><img src="/assets/img/owl/item-1.png" class="full-width" alt=""></a></div>
                    <div><a href="#"><img src="/assets/img/owl/item-1.png" class="full-width" alt=""></a></div>
                    <div><a href="#"><img src="/assets/img/owl/item-1.png" class="full-width" alt=""></a></div>
                    <div><a href="#"><img src="/assets/img/owl/item-1.png" class="full-width" alt=""></a></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3">
                <div class="Product-item horizontal horizontal-center bordered border-radius">
                    <div class="Product-item-header">
                        <a href="#"><img src="/assets/img/products/item-1.png" alt=""></a>
                    </div>
                    <div class="Product-item-content">
                        <p class="name"><a href="#">Chevrolet Captiva 2012</a></p>
                        <p class="price">5 990 ₽</p>
                    </div>
                    <div class="Product-item-footer">

                    </div>
                </div>
                <div class="Product-item horizontal horizontal-center bordered border-radius">
                    <div class="Product-item-header">
                        <a href="#"><img src="/assets/img/products/item-1.png" alt=""></a>
                    </div>
                    <div class="Product-item-content">
                        <p class="name"><a href="#">Chevrolet Captiva 2012</a></p>
                        <p class="price">5 990 ₽</p>
                    </div>
                    <div class="Product-item-footer">

                    </div>
                </div>
                <div class="Product-item horizontal horizontal-center bordered border-radius">
                    <div class="Product-item-header">
                        <a href="#"><img src="/assets/img/products/item-1.png" alt=""></a>
                    </div>
                    <div class="Product-item-content">
                        <p class="name"><a href="#">Chevrolet Captiva 2012</a></p>
                        <p class="price">5 990 ₽</p>
                    </div>
                    <div class="Product-item-footer">

                    </div>
                </div>
            </div>
        </div>-->
        @if (count($newGoods))
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h2 class="">Новые товары</h2>
                </div>
            </div>
            @foreach ($newGoods as $key => $product)
                @if ($key % 4 == 0)
                    <div class="row Product-item-grid">
                @endif
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <div class="Product-item bordered border-radius">
                            <div class="Product-item-header">
                                <a href="{{ route('goods.item', ['goods' => $product->id]) }}"><img src="{{ $product->imagePath }}" alt=""></a>
                            </div>
                            <div class="Product-item-content">
                                <p class="name"><a href="{{ route('goods.item', ['goods' => $product->id]) }}">{{ $product->name }}</a></p>
                                <p class="price">{{ $product->priceFormat }} ₽</p>
                            </div>
                            <div class="Product-item-footer">
                                @include('partials/' . $product->category->code . '/add_info', ['unit' => $product->unit])
                            </div>
                        </div>
                    </div>
                @if ($key % 4 == 3)
                </div>
                @endif
            @endforeach
            @if ($key % 4 != 3)
                </div>
            @endif
            <!--<div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <a href="#" class="all-lots">Все товары</a>
                </div>
            </div>-->
        @endif

        @if (count($visitedGoods))
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h2 class="reset-top">Вы уже смотрели</h2>
            </div>
        </div>
        <div class="row">
            @foreach ($visitedGoods as $product)
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="Product-item horizontal horizontal-center bordered border-radius m-top">
                    <div class="Product-item-header">
                        <a href="{{ route('goods.item', ['goods' => $product->id]) }}"><img src="{{ $product->imagePath  }}" alt=""></a>
                    </div>
                    <div class="Product-item-content">
                        <p class="name"><a href="{{ route('goods.item', ['goods' => $product->id]) }}">{{ $product->name }}</a></p>
                        <p class="price">{{ $product->priceFormat }} ₽</p>
                    </div>
                    <div class="Product-item-footer">

                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!--<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <a href="#" class="all-lots">Вся история просмотров</a>
            </div>
        </div>-->
        @endif

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 text-page">
                <h1>Inlot – открытая автомобильная онлайн площадка-аукцион</h1>
                <p>Торговая онлайн площадка Inlot была создана, чтобы представить самые выгодные предложения на рынке автомобилей и запчастей, а также наладить эффективную связь между продавцами и покупателями. Первые смогут быстро и выгодно оформить продажу, вторые – найти наиболее приемлемые цены и принять участие в интернет-аукционе.</p>
                <h2>Быстро и выгодно продать автомобиль и запчасти</h2>
                <p>Inlot для продавцов – это универсальная онлайн площадка, позволяющая быстро найти покупателя и совершить выгодную сделку. Вы получаете доступ к цифровой доске объявлений, где в любой момент сможете опубликовать собственное предложение о продаже автомобиля или запчастей, включая шины, диски и колеса. Воспользуйтесь возможностью удачно продать подержанное авто, выставив его на аукцион. Большое количество просмотров гарантировано!</p>
                <h2>Купить автомобиль и запчасти по выгодной цене</h2>
                <p>Inlot для покупателей – это возможность быстро найти автомобиль, который вы так давно искали. Удобный поиск откроет для вас все наиболее подходящие предложения. Воспользуйтесь фильтром и просматривайте только те предложения, которые соответствуют вашим параметрам и бюджету. Покупатели получают неограниченный доступ к нашему онлайн автопарку, а также широкому выбору запчастей, включая диски и резину. Интернет-аукцион – еще одна уникальная функция портала, позволяющая купить подержанный автомобиль по максимально низкой цене.</p>
            </div>
        </div>
        <br>
        <br>
    </div>
</section>
<!-- content END -->
@endsection
