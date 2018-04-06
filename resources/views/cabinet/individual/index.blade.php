@extends('layouts.cabinet')

@section('title', 'Личный кабинет — Главная — Inlot.ru')

@section('content')
<!-- content  -->
<section class="content">
    <div class="container">
        <!--title and description-->
        <div class="row">
            @include('includes.left_menu')
            <div class="col-xs-12 col-md-9 col-sm-9">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12">
                        <div class="Profile-header">
                            <div><img src="{{ Auth::user()->image80Path }}" alt="" class="img-circle"></div>
                            <div>
                                <div>
                                    <h1 class="Profile-header--name">{{ Auth::user()->name }}</h1>
                                    <p class="Profile-header--from">На inlot.ru с {{ Auth::user()->registerDate }}</p>
                                </div>
                                <div>
                                    <div>
                                        <p class="Profile-header--user">{{ Auth::user()->login }}</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('cabinet.profile') }}" class="Profile-header--settings"><span><i class="fa fa-pencil"></i></span><span>Редактировать профиль</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12">
                        <hr>
                    </div>
                </div>

                @include('includes/visited_goods')

                <!--<div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <h2 class="reset-top Product-item--title">Отзывы <span class="Product-item--count">(65)</span></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="Product-item horizontal horizontal-center bordered border-radius m-top">
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
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="Product-item horizontal horizontal-center bordered border-radius m-top">
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
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="Product-item horizontal horizontal-center bordered border-radius m-top">
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
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a href="#" class="all-lots">Все отзывы</a>
                    </div>
                </div>
            </div>-->
        </div><!-- title end -->
    </div>
</section>
<!-- content END -->
@endsection