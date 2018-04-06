@extends('layouts/site')

@section('title', 'Оформление заказа — Inlot.ru')

@section('content')
<!-- content  -->
<section class="content">
    <div class="container">
        <!--title and description-->
        <div class="row">
            <div class="col-xs-12 col-md-12 col-sm-12">
                <div class="Settings-header">
                    <h1>Оформление заказа</h1>
                </div>
                <!-- form -->
                {{ Form::open(['url' => route('goods.order', ['goods' => $goods->id]), 'class' => 'Order']) }}
                    <div class="row">
                        <div class="col-xs-12 col-sm-9 col-md-9">
                            <!-- product-->
                            <div class="product-item-vertical" data-item="product">
                                <div class="product-item-vertical--content">
                                    <div class="product-item-vertical--img">
                                        <a href><img src="{{ $goods->imagePath }}" alt="" class="full-width"></a>
                                    </div>
                                    <div class="product-item-vertical--description">
                                        <div>
                                            <div class="product-item-vertical--name"><p><a href="#">{{ $goods->name }}</a></p></div>
                                            <div class="product-item-vertical--price"><p>{{ $goods->priceFormat }} ₽</p></div>
                                        </div>
                                        <div>
                                            <div class="product-item-vertical--info">
                                                @include('partials/' . $goods->category->code . '/add_info', ['unit' => $goods->unit])
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-item-vertical--actions flex">
                                        <div class="width flex">
                                            <div>
                                                <div class="from">
                                                    <div><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                                    <div><p>{{ $goods->city->name }}</p></div>
                                                </div>
                                                <div class="who">
                                                    <div><a href="#">{{ $goods->user->companyName }}</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- product END-->
                        </div>
                    </div><!-- products vertical END-->
                    <div class="row">
                        <div class="col-xs-12 col-sm-9 col-md-9">
                            <p class="Order-total"><span>Итого</span>{{ $goods->priceFormat }} ₽</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-9 col-md-9">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                        <label>Комментарий к заказу</label>
                                    </div>
                                    <div class="col-xs-12 col-md-12 col-sm-12">
                                        {{ Form::textarea('comment', null, ['type' => 'text', 'class' => 'form-control', 'rows' => 6]) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-9 col-md-9">
                            <button type="submit" class="btn btn-orange">Оформить заказ</button>
                        </div>
                    </div>
                    <!-- will remove this -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-9 col-md-9">
                            <br>
                        </div>
                    </div><!-- will remove this -->
                {{ Form::close() }}
            </div>
        </div><!-- title end -->
    </div>
</section>
<!-- content END -->
@endsection