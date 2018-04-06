@extends('layouts/site')

@section('title', $title)

@section('content')

    <!-- content  -->
    <section class="content">
        <div class="container">
            <!--bread-crumbs -->
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <ul class="bread-crumbs no-margin">
                        <li><a href="#">Транспорт и запчасти</a></li>
                        <li><a href="#">Легковые автомобили</a></li>
                    </ul>
                </div>
            </div>
            <!--bread-crumbs -->
            <!--title and description-->
            <div class="row">
                <div class="col-xs-12 col-md-3 col-sm-3">
                    <nav class="my-navigation left-menu">
                        <ul>
                            <li class="has-inner active">
                                <div><a href="#">Мои товары</a></div>
                                <ul>
                                    <li><a href="#">Все товары</a></li>
                                    <li><a href="#">Товары в продаже</a></li>
                                    <li><a href="#" class="active">Проданные</a></li>
                                    <li><a href="#">Непроданные</a></li>
                                    <li><a href="#">Удаленные</a></li>
                                    <li><a href="#">Черновики</a></li>
                                </ul>
                            </li>

                            <li class="has-inner">
                                <div>
                                    <a href="#collapse1" class="collapse collapsed" data-toggle="collapse">
                                        <span>Настройки</span>
                                        <span>
                                                        <i class="glyphicon glyphicon-menu-right"></i>
                                                        <i class="glyphicon glyphicon-menu-down"></i>
                                                    </span>
                                    </a>
                                </div>

                                <div class="collapse" id="collapse1">
                                    <ul>
                                        <li><a href="#">Все товары</a></li>
                                        <li><a href="#">Товары в продаже</a></li>
                                        <li><a href="#" class="active">Проданные</a></li>
                                        <li><a href="#">Непроданные</a></li>
                                        <li><a href="#">Удаленные</a></li>
                                        <li><a href="#">Черновики</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-xs-12 col-md-9 col-sm-9">
                    <div class="Settings-header">
                        <h1>Правила составления объявлений</h1>
                    </div>
                    <div class="Settings-content">
                        <p>Маркетинговая коммуникация без оглядки на авторитеты нейтрализует конвергентный портрет потребителя. Имидж определяет маркетинг. Инвестиционный продукт основан на опыте.</p>
                        <p>Бизнес-стратегия, вопреки мнению П.Друкера, осмысленно обуславливает рекламный макет. Представляется логичным, что эволюция мерчандайзинга нейтрализует мониторинг активности. PR, вопреки мнению П.Друкера, неоднозначен.</p>
                        <p>К тому же медийная реклама программирует креативный имидж предприятия. Стимулирование коммьюнити, как принято считать, исключительно масштабирует коллективный рекламный клаттер. Фокус-группа инновационна.</p>
                    </div>
                </div>
            </div><!-- title end -->
        </div>
    </section>
@endsection