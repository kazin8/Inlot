@extends('layouts.cabinet')

@section('title', 'Личный кабинет — Мои товары — Новый товар — Inlot.ru')

@section('content')
<!-- content  -->
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h4 class="grey">Проверьте информацию о товаре перед началом продаж</h4>
            </div>
        </div>
        <!-- item name -->
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <h1 class="Card-name">{{ $goods->name }}</h1>
            </div>
        </div><!-- item name END-->
        <!-- item details and actions -->
        <div class="row">
            @if ($goods->getFullImagePathEmpty() or count($goods->gallery))
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <!-- item photo -->
                    <div class="Card-photo">
                        <div class="fotorama" data-nav="thumbs" data-height="450">
                            @if ($goods->getFullImagePathEmpty())
                                <a href="#" data-thumbratio="92/67"><img src="{{ $goods->getFullImagePathEmpty() }}" alt=""></a>
                            @endif
                            @if (count($goods->gallery))
                                @foreach ($goods->gallery as $photo)
                                    <a href="#" data-thumbratio="92/67"><img src="{{ $photo->imagePath }}" alt=""></a>
                                @endforeach
                            @endif
                        </div>
                    </div><!-- item photo END -->
                </div>
            @endif
            <div class="col-xs-12 col-sm-6 col-md-6">
                <!-- item actions -->
                <div class="Card-actions">
                    <div class="seller-info">
                        <div>
                            <div class="profile">
                                <div><a href="#"><img src="{{ $goods->user->image30Path }}" class="img-circle" alt=""></a></div>
                                <div>
                                    <p class="profile-name">Продавец: <a href="#">{{ $goods->user->companyName }}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="seller-place">
                        <p>Местонахождение товара: <a href="#" data-toggle="modal" data-target="#map">{{ $goods->city->name }}{{ $goods->address ? ', ' . $goods->address : '' }}</a></p>
                    </div>
                </div><!-- item actions -->

                @if ($autoPart->state)
                <div class="Card-status">
                    <div><p>Состояние товара: <span>{{ $autoPart->state }}</span></p></div>
                </div>
                @endif
                <div><p>В наличии: {{ $goods->count }} шт.</p></div>

                <div class="Card-buy">
                    <div class="my-flex">
                        <div>
                            <div class="current-price my-flex">
                                <div><p>Купить сейчас</p></div>
                                <div><p>{{ $goods->priceFormat }} ₽</p></div>
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
                @if ($goods->delivery_info or $goods->payment_requirement)
                    <div class="delivery-details">
                        @if ($goods->delivery_info)
                            <p><span>Доставка: </span>{{ $goods->delivery_info }}</p>
                        @endif
                        @if ($goods->payment_requirement)
                            <p><span>Оплата: </span>{{ $goods->payment_requirement }}</p>
                        @endif
                    </div>
                @endif

            </div>
        </div>

        <div class="Card-tabs">
            <!-- Description -->
            <div class="row Card-tabs-description">
                <div class="col-xs-12 col-sm-8 col-md-8">
                    <h3>Характеристики запчасти</h3>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="text-right">
                        <a href="#" class="action">Пожаловаться на товар</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <table class="table m-left">
                        @if ($autoPart->kind)
                            <tr>
                                <td>Вид запчасти</td>
                                <td>{{ $autoPart->kind }}</td>
                            </tr>
                        @endif
                        @if ($autoPart->original_number)
                            <tr>
                                <td>Оригинальный номер</td>
                                <td>{{ $autoPart->original_number }}</td>
                            </tr>
                        @endif
                        @if (count($autoPart->cars))
                            <tr>
                                <td>Применимость</td>
                                <td>{{ implode(', ', $autoPart->cars) }}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>

            @if ($goods->comment)
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <h3>Комментарий продавца</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <p>{!! nl2br(e($goods->comment)) !!}</p>
                    </div>
                </div>
            @endif
            <!-- Description END-->
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-1 col-sm-2">
                <a href="{{ route('cabinet.goods.edit', ['step' => 3, 'goods' => $goods->id]) }}" class="">Назад</a>

            </div>
            <div class="col-xs-12 col-md-3 col-sm-3">
                <!-- т.к. это не форма то все данные требуется отправить либо простым аяксом либо просто данный сабмит обернуть в форму что я собсвенно и сделал, так же массив со спрятаным инпутом -->
                {!! Form::open(['url' => route('cabinet.goods.update', ['step' => 4, 'goods' => $goods->id]), 'method' => 'PATCH']) !!}
                <button type="submit" class="btn btn-orange btn-block">Далее</button>
                <input type="hidden" name="param[]" />
                {!! Form::close() !!}

            </div>
        </div>

        <!-- tabs description END-->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                </br>
            </div>
        </div>
    </div>
</section>
<!-- content END -->
@endsection