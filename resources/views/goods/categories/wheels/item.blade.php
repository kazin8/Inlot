@extends('layouts.cabinet')

@section('title', 'Купить '.$wheel->seasonality.' колеса '.$wheel->profile_width.'/'.$wheel->profile_height.'R'.$wheel->diameter.': цена, фото. Продажа колес на Inlot.ru')
@section('d', 'Купить '.$wheel->seasonality.' колеса '.$wheel->profile_width.'/'.$wheel->profile_height.'R'.$wheel->diameter.' на торговой площадке Inlot.ru. Ознакомиться с ценами, фото, характеристиками и подробным описанием колес.')

@section('content')
<!-- content  -->
<section class="content">
    <div class="container">
        @include('includes/breadcrumbs')
        <!-- item name -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h1 class="Card-name">{{ $goods->name }}</h1>
            </div>
        </div><!-- item name END-->
        <!-- item details and actions -->
        <div class="row">
            @if ($goods->getFullImagePathEmpty() count($goods->gallery))
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
                                    <p class="profile-name">Продавец: {{ $goods->user->companyName }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="seller-place">
                        <p>Местонахождение товара: <a href="#" data-toggle="modal" data-target="#map" id="address-for-map">{{ $goods->city->name }}{{ $goods->address ? ', ' . $goods->address : '' }}</a></p>
                    </div>
                </div><!-- item actions -->

                @if ($wheel->state)
                <div class="Card-status">
                    <div><p>Состояние товара: <span>{{ $wheel->state }}</span></p></div>
                </div>
                @endif
                

                <div class="Card-amount">
                    <form action="" class="CardBuy" data-item-amount="{{ $goods->count }}">
                        <div><p>Количество</p></div>
                        <div class="form-group">
                            <input type="text" class="form-control" data-item="format" name="cardAmount">
                            <input type="hidden" data-item="format-to" name="carCardAmount" />
                            <div class="err">

                            </div>
                        </div>
                        <div><p>В наличии: {{ $goods->count }} шт.</p></div>
                        <button class="btn btn-primary hidden" type="submit"></button>
                    </form>
                </div>

                <div class="Card-buy">
                    <div class="my-flex">
                        <div>
                            <div class="current-price my-flex">
                                <div><p>Купить сейчас</p></div>
                                <div><p>{{ $goods->priceFormat }} ₽</p></div>
                            </div>
                        </div>
                        <div>
                            @if (Auth::check() and Auth::user()->id !== $goods->user_id and $goods->status === \App\Goods::ON_SALE)
                            <a href="{{ route('goods.viewOrder', ['goods' => $goods->id]) }}"><button type="button" class="btn btn-success">Купить сейчас</button></a>
                            <!--тут я хз как заменить линк поэтому продублировал-->
                            <button type="button" class="btn btn-success" data-item="cartSubmit">Купить сейчас</button>
                            <!--тут я хз как заменить линк поэтому продублировал-->
                            @elseif (!Auth::check() and $goods->status === \App\Goods::ON_SALE)
                            <a href="{{ url('/login') }}"><button type="button" class="btn btn-success">Купить сейчас</button></a>
                            @endif
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
                    <h3>Характеристики колес</h3>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="text-right">
                        <a href="#" class="action">Пожаловаться на товар</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <table class="table m-left table-line-heigth">
                        @if ($wheel->rimType)
                        <tr>
                            <td>Тип диска</td>
                            <td>{{ $wheel->rimType }}</td>
                        </tr>
                        @endif
                        @if ($wheel->diameter)
                        <tr>
                            <td>Диаметр</td>
                            <td>{{ $wheel->diameter }} дюймов</td>
                        </tr>
                        @endif
                        @if ($wheel->seasonality)
                        <tr>
                            <td>Сезонность</td>
                            <td>{{ $wheel->seasonality }}</td>
                        </tr>
                        @endif
                        @if ($wheel->profile_width)
                        <tr>
                            <td>Ширина профиля</td>
                            <td>{{ $wheel->profile_width }} мм</td>
                        </tr>
                        @endif
                        @if ($wheel->profile_height)
                        <tr>
                            <td>Высота профиля</td>
                            <td>{{ $wheel->profile_height }} мм</td>
                        </tr>
                        @endif
                        @if (count($wheel->width))
                        <tr>
                            <td>Ширина обода</td>
                            <td>{{ $wheel->width }} дюймов</td>
                        </tr>
                        @endif
                        @if ($wheel->number_of_holes)
                        <tr>
                            <td>Количество отверстий</td>
                            <td>{{ $wheel->number_of_holes }}</td>
                        </tr>
                        @endif
                        @if ($wheel->holeDiameter)
                        <tr>
                            <td>Диаметр расположения отверстий</td>
                            <td>{{ $wheel->holeDiameter }} мм</td>
                        </tr>
                        @endif
                        @if ($wheel->radius)
                        <tr>
                            <td>Вылет (ЕТ)</td>
                            <td>{{ $wheel->radius }} мм</td>
                        </tr>
                        @endif
                        @if (count($wheel->cars))
                        <tr>
                            <td>Применимость</td>
                            <td>{{ implode(', ', $wheel->cars) }}</td>
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

        <!-- tabs description END-->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
            </br>
        </div>
    </div>
</div>
</section>
<!-- content END -->
<!-- modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="map">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ $goods->user->companyName }}</h4>
                <p class="modal-description">
                    <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $goods->city->name }}, {{ $goods->address }}
                </p>
            </div>
            <div class="modal-body">
                <div id="map_canvas" style="width:100%; height:450px"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection