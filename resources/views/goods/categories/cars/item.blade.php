@extends('layouts.site')

@section('title', 'Купить '.$car->marks->name.' '.$car->models->name.' '.$car->date_release_id.' года, '.$goods->city->name.': цена, фото. Продажа автомобилей '.$car->marks->name.' на Inlot.ru')
@section('d', 'Купить автомобиль '.$car->marks->name.' '.$car->models->name.' '.$car->date_release_id.' года, пробег '.$car->run.' км, цвет '.mb_strtolower($car->color).' на торговой площадке Inlot.ru. Ознакомиться с ценами, фото, характеристиками и подробным описанием автомобиля '.$car->marks->name.' '.$car->models->name)

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
                        @if ($goods->video)
                        <a data-video="true" href="{{ $goods->video }}" data-thumbratio="92/67"></a>
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
                        <!--<div>
                            <div>
                                <a href="#" class="btn-link"><span><i class="fa fa-phone" aria-hidden="true"> </i></span><span>Показать телефон</span></a>
                            </div>
                        </div>-->
                    </div>
                    <div class="seller-place">
                        <p>Местонахождение товара: <a href="#" data-toggle="modal" data-target="#map" id="address-for-map">{{ $goods->city->name }}{{ $goods->address ? ', ' . $goods->address : '' }}</a></p>
                    </div>
                </div><!-- item actions -->

                @if ($car->state)
                <div class="Card-status">
                    <div><p>Состояние товара: <span>{{ $car->state }}</span></p></div>
                </div>
                @endif

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
        </div><!-- item details and actions -->
        <!-- tabs description -->
        <!-- Nav tabs -->
        <div class="Card-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#tab1" data-toggle="tab">Характеристики</a></li>
                <li><a href="#tab3" data-toggle="tab">Шины и диски</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h3>Характеристики автомобиля</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <table class="table table-line-heigth">
                                @if ($car->date_release_id)
                                <tr>
                                    <td>Год выпуска</td>
                                    <td>{{ $car->date_release_id }}</td>
                                </tr>
                                @endif
                                @if ($car->run !== null)
                                <tr>
                                    <td>Пробег</td>
                                    <td>{{ $car->run }}, км</td>
                                </tr>
                                @endif
                                @if ($car->vin)
                                <tr>
                                    <td>VIN-номер</td>
                                    <td>{{ $car->vin }}</td>
                                </tr>
                                @endif
                                @if ($car->pts)
                                <tr>
                                    <td>ПТС</td>
                                    <td>{{ $car->pts }}</td>
                                </tr>
                                @endif
                                @if ($car->ptsOwnerNumber)
                                <tr>
                                    <td>Владельцев по ПТС</td>
                                    <td>{{ $car->ptsOwnerNumber }}</td>
                                </tr>
                                @endif
                                @if ($car->gear)
                                <tr>
                                    <td>Привод</td>
                                    <td>{{ $car->gear }}</td>
                                </tr>
                                @endif
                                @if ($car->body)
                                <tr>
                                    <td>Тип кузова</td>
                                    <td>{{ $car->body }}</td>
                                </tr>
                                @endif
                                @if ($car->color)
                                <tr>
                                    <td>Цвет</td>
                                    <td>{{ $car->color }}</td>
                                </tr>
                                @endif
                                @if ($car->engine)
                                <tr>
                                    <td>Тип двигателя</td>
                                    <td>{{ $car->engine }}</td>
                                </tr>
                                @endif
                                @if ($car->engine_capacity)
                                <tr>
                                    <td>Объем двигателя</td>
                                    <td>{{ $car->engine_capacity }}</td>
                                </tr>
                                @endif
                                @if ($car->power)
                                <tr>
                                    <td>Мощность</td>
                                    <td>{{ $car->power }}</td>
                                </tr>
                                @endif
                                @if ($car->rudder)
                                <tr>
                                    <td>Руль</td>
                                    <td>{{ $car->rudder }}</td>
                                </tr>
                                @endif
                                @if ($car->kpp)
                                <tr>
                                    <td>КПП</td>
                                    <td>{{ $car->kpp }}</td>
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

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <h3>Комплектация</h3>
                        </div>
                    </div>
                    @if ($car->sunroof or $car->tinted_windows or $car->xenon_headlights or $car->alloy_wheels or $car->antilock_system or $car->traction_control_system or $car->stability_system or $car->parktronic or $car->airbags or $car->salon or $car->salon_color or $car->on_board_computer or $car->rain_sensor or $car->light_sensor or $car->cruise_control or $car->navigation_system or $car->mirror_heating or $car->headlight_washer or $car->power_steering or $car->central_locking or $car->electric_mirrors or $car->windows or $car->driver_seat or $car->passenger_seat or $car->steering_control or $car->wheel_heating or $car->seat_heating or $car->climate or $car->full_time_alarm or $car->immobilizer or $car->feedback or $car->remote_engine_start or $car->cd or $car->tv)
                    <div class="complictations">
                        <div class="row">
                            @if ($car->sunroof or $car->tinted_windows or $car->xenon_headlights or $car->alloy_wheels or $car->antilock_system or $car->traction_control_system or $car->stability_system or $car->parktronic or $car->airbags)
                            <div class="col-xs-12 col-sm-3 col-md-3">
                                @if ($car->sunroof or $car->tinted_windows or $car->xenon_headlights or $car->alloy_wheels)
                                <ul>
                                    <li>Экстерьер</li>
                                    @if ($car->sunroof)<li>Люк на крыше</li>@endif
                                    @if ($car->tinted_windows)<li>Тонированные стекла</li>@endif
                                    @if ($car->xenon_headlights)<li>Ксеноновые фары</li>@endif
                                    @if ($car->alloy_wheels)<li>Легкосплавные диски</li>@endif
                                </ul>
                                @endif
                                @if ($car->antilock_system or $car->traction_control_system or $car->stability_system or $car->parktronic)
                                <ul>
                                    <li>Безопасность</li>
                                    @if ($car->antilock_system)<li>Антиблокировочная система (ABS)</li>@endif
                                    @if ($car->traction_control_system)<li>Антипробуксовочная система</li>@endif
                                    @if ($car->stability_system)<li>Система курсовой устойчивости</li>@endif
                                    @if ($car->parktronic)<li>Парктроник</li>@endif
                                </ul>
                                @endif
                                @if ($car->airbags)
                                <ul>
                                    <li>Подушки безопасности</li>
                                    <li>{{ \App\Car::$airbagNames[$car->airbags] }}</li>
                                </ul>
                                @endif
                            </div>
                            @endif
                            @if ($car->salon or $car->salon_color or $car->on_board_computer or $car->rain_sensor or $car->light_sensor or $car->cruise_control or $car->navigation_system or $car->mirror_heating or $car->headlight_washer or $car->power_steering or $car->central_locking)
                            <div class="col-xs-12 col-sm-3 col-md-3">
                                @if ($car->salon)
                                <ul>
                                    <li>Салон</li>
                                    <li>{{ \App\Car::$salonNames[$car->salon] }}</li>
                                </ul>
                                @endif
                                @if ($car->salon_color)
                                <ul>
                                    <li>Цвет салона</li>
                                    <li>{{ \App\Car::$salonColorNames[$car->salon_color] }}</li>
                                </ul>
                                @endif
                                @if ($car->on_board_computer or $car->rain_sensor or $car->light_sensor or $car->cruise_control or $car->navigation_system or $car->mirror_heating or $car->headlight_washer or $car->power_steering or $car->central_locking)
                                <ul>
                                    <li>Функциональное оборудование</li>
                                    @if ($car->on_board_computer)<li>Бортовой компьютер</li>@endif
                                    @if ($car->rain_sensor)<li>Датчик дождя</li>@endif
                                    @if ($car->light_sensor)<li>Датчик света</li>@endif
                                    @if ($car->cruise_control)<li>Круиз-контроль</li>@endif
                                    @if ($car->navigation_system)<li>Навигационная система</li>@endif
                                    @if ($car->mirror_heating)<li>Обогрев зеркал</li>@endif
                                    @if ($car->headlight_washer)<li>Омыватель фар</li>@endif
                                    @if ($car->power_steering)<li>Усилитель руля</li>@endif
                                    @if ($car->central_locking)<li>Центральный замок</li>@endif
                                </ul>
                                @endif
                            </div>
                            @endif
                            @if ($car->electric_mirrors or $car->windows or $car->driver_seat or $car->passenger_seat or $car->steering_control)
                            <div class="col-xs-12 col-sm-3 col-md-3">
                                @if ($car->electric_mirrors)
                                <ul>
                                    <li>Регулировки</li>
                                    <li>Электропривод зеркал</li>
                                </ul>
                                @endif
                                @if ($car->windows)
                                <ul>
                                    <li>Стеклоподъемники</li>
                                    <li>{{ \App\Car::$windowsNames[$car->windows] }}</li>
                                </ul>
                                @endif
                                @if ($car->driver_seat)
                                <ul>
                                    <li>Сиденье водителя</li>
                                    <li>{{ \App\Car::$driverSeatNames[$car->driver_seat] }}</li>
                                </ul>
                                @endif
                                @if ($car->passenger_seat)
                                <ul>
                                    <li>Сиденье пассажира</li>
                                    <li>{{ \App\Car::$passengerSeatNames[$car->passenger_seat] }}</li>
                                </ul>
                                @endif
                                @if ($car->steering_control)
                                <ul>
                                    <li>Регулировка руля</li>
                                    <li>{{ \App\Car::$steeringControlNames[$car->steering_control] }}</li>
                                </ul>
                                @endif
                            </div>
                            @endif
                            @if ($car->wheel_heating or $car->seat_heating or $car->climate or $car->full_time_alarm or $car->immobilizer or $car->feedback or $car->remote_engine_start or $car->cd or $car->tv)
                            <div class="col-xs-12 col-sm-3 col-md-3">
                                @if ($car->wheel_heating or $car->seat_heating)
                                <ul>
                                    <li>Комфорт</li>
                                    @if ($car->wheel_heating)<li>Обогрев руля</li>@endif
                                    @if ($car->seat_heating)<li>Обогрев сидений</li>@endif
                                </ul>
                                @endif
                                @if ($car->climate)
                                <ul>
                                    <li>Климат</li>
                                    <li>{{ \App\Car::$climateNames[$car->climate] }}</li>
                                </ul>
                                @endif
                                @if ($car->full_time_alarm or $car->immobilizer or $car->feedback or $car->remote_engine_start)
                                <ul>
                                    <li>Сигнализация</li>
                                    @if ($car->full_time_alarm)<li>Штатная</li>@endif
                                    @if ($car->immobilizer)<li>Иммобилайзер</li>@endif
                                    @if ($car->feedback)<li>Обратная связь</li>@endif
                                    @if ($car->remote_engine_start)<li>Дистанционный запуск двигателя</li>@endif
                                </ul>
                                @endif
                                @if ($car->cd or $car->tv)
                                <ul>
                                    <li>Мультимедиа</li>
                                    @if ($car->cd)<li>CD</li>@endif
                                    @if ($car->tv)<li>TV</li>@endif
                                </ul>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                    @else
                    Не указано.
                    @endif
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <hr>
                        </div>
                    </div>

                </div>
                <div class="tab-pane" id="tab3">
                    <div class="row">
                        <div     class="col-xs-12 col-sm-12 col-md-12">
                            <h3>Шины и диски</h3>
                        </div>
                    </div>
                    @if ($car->tyre or $car->fl_profile_depth or $car->fl_disk_defect or $car->fl_cap_defect or $car->flTyreImagePath or $car->fr_profile_depth or $car->fr_disk_defect or $car->fr_cap_defect or $car->frTyreImagePath or $car->bl_profile_depth or $car->bl_disk_defect or $car->bl_cap_defect or $car->blTyreImagePath or $car->br_profile_depth or $car->br_disk_defect or $car->br_cap_defect or $car->brTyreImagePath)
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <p><strong>Шины</strong>@if ($car->tyre) {{ $car->tyre }} @else не указано @endif</p>
                        </div>
                    </div>
                    @if ($car->fl_profile_depth or $car->fl_disk_defect or $car->fl_cap_defect or $car->flTyreImagePath or $car->fr_profile_depth or $car->fr_disk_defect or $car->fr_cap_defect or $car->frTyreImagePath or $car->bl_profile_depth or $car->bl_disk_defect or $car->bl_cap_defect or $car->blTyreImagePath or $car->br_profile_depth or $car->br_disk_defect or $car->br_cap_defect or $car->brTyreImagePath)
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <table class="table table-card-static">
                                <tr>
                                    <td></td>
                                    <td>Левое переднее</td>
                                    <td>Левое заднее</td>
                                    <td>Правое переднее</td>
                                    <td>Правое заднее</td>
                                </tr>
                                <tr>
                                    <td>Глубина профилей</td>
                                    <td>@if ($car->fl_profile_depth) {{ $car->fl_profile_depth }} мм @else не указано @endif</td>
                                    <td>@if ($car->bl_profile_depth) {{ $car->bl_profile_depth }} мм @else не указано @endif</td>
                                    <td>@if ($car->fr_profile_depth) {{ $car->fr_profile_depth }} мм @else не указано @endif</td>
                                    <td>@if ($car->br_profile_depth) {{ $car->br_profile_depth }} мм @else не указано @endif</td>
                                </tr>
                                <tr>
                                    <td>Диски</td>
                                    <td>@if ($car->fl_disk_defect) {{ $car->fl_disk_defect }} @else не указано @endif</td>
                                    <td>@if ($car->bl_disk_defect) {{ $car->bl_disk_defect }} @else не указано @endif</td>
                                    <td>@if ($car->fr_disk_defect) {{ $car->fr_disk_defect }} @else не указано @endif</td>
                                    <td>@if ($car->br_disk_defect) {{ $car->br_disk_defect }} @else не указано @endif</td>
                                </tr>
                                <tr>
                                    <td>Колпаки колес</td>
                                    <td>@if ($car->fl_cap_defect) {{ $car->fl_cap_defect }} @else не указано @endif</td>
                                    <td>@if ($car->bl_cap_defect) {{ $car->bl_cap_defect }} @else не указано @endif</td>
                                    <td>@if ($car->fr_cap_defect) {{ $car->fr_cap_defect }} @else не указано @endif</td>
                                    <td>@if ($car->br_cap_defect) {{ $car->br_cap_defect }} @else не указано @endif</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>@if ($car->flTyreImagePath)<a href="{{ $car->flTyreImagePath }}" data-lightbox="group1"><img src="{{ $car->flTyreImagePath }}" class="full-width" alt=""></a>@endif</td>
                                    <td>@if ($car->blTyreImagePath)<a href="{{ $car->blTyreImagePath }}" data-lightbox="group2"><img src="{{ $car->blTyreImagePath }}" class="full-width" alt=""></a>@endif</td>
                                    <td>@if ($car->frTyreImagePath)<a href="{{ $car->frTyreImagePath }}" data-lightbox="group3"><img src="{{ $car->frTyreImagePath }}" class="full-width" alt=""></a>@endif</td>
                                    <td>@if ($car->brTyreImagePath)<a href="{{ $car->brTyreImagePath }}" data-lightbox="group4"><img src="{{ $car->brTyreImagePath }}" class="full-width" alt=""></a>@endif</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    @endif
                    @else
                    Не указано.
                    @endif

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- tabs description END-->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">

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