<div class="col-xs-12 col-md-3 col-sm-3">
    <nav class="my-navigation left-menu">
        <ul>
            @if (Auth::user()->type == 2)
            <li class="has-inner">
                <div>
                    <a href="#my-goods" data-toggle="collapse" class="collapse {{ (isset($goodsListActive) and $goodsListActive) ? '' : 'collapsed' }}">
                        <span>Мои товары</span>
                        <span><i class="glyphicon glyphicon-menu-right"></i><i class="glyphicon glyphicon-menu-down"></i></span>
                    </a>
                </div>
                <div class="collapse {{ (isset($goodsListActive) and $goodsListActive) ? 'in' : '' }}" id="my-goods">
                    <ul>
                        <li><a href="{{ route('cabinet.goods.fullList') }}" {{ (isset($fullListActive) and $fullListActive) ? 'class=active' : '' }}>Все товары</a></li>
                        <li><a href="{{ route('cabinet.goods.onSaleList') }}" {{ (isset($onSaleListActive) and $onSaleListActive) ? 'class=active' : '' }}>Товары в продаже</a></li>
                        <!--<li><a href="#">Проданные</a></li>
                        <li><a href="#">Непроданные</a></li>-->
                        <li><a href="{{ route('cabinet.goods.deletedList') }}" {{ (isset($deletedListActive) and $deletedListActive) ? 'class=active' : '' }}>Удаленные</a></li>
                        <li><a href="{{ route('cabinet.goods.draftList') }}" {{ (isset($draftListActive) and $draftListActive) ? 'class=active' : '' }}>Черновики</a></li>
                    </ul>
                </div>
            </li>
            <li class="has-inner {{ (isset($salesActive) and $salesActive) ? 'active' : '' }}"><div><a href="{{ route('cabinet.sales') }}">Продажи</a></div></li>
            @endif
            <li class="has-inner">
                <div>
                    <a href="#my-orders" data-toggle="collapse" class="collapse {{ (isset($ordersActive) and $ordersActive) ? '' : 'collapsed' }}">
                        <span>Покупки</span>
                        <span><i class="glyphicon glyphicon-menu-right"></i><i class="glyphicon glyphicon-menu-down"></i></span>
                    </a>
                </div>
                <div class="collapse {{ (isset($ordersActive) and $ordersActive) ? 'in' : '' }}" id="my-orders">
                    <ul>
                        <li><a href="{{ route('cabinet.orders') }}" {{ (isset($ordersActive) and $ordersActive) ? 'class=active' : '' }}>Мои заказы</a></li>
                        <!--<li><a href="#">Аукционы с моими ставками</a></li>
                        <li><a href="#">Невыигранные аукционы</a></li>
                        <li><a href="#">Выигранные аукционы</a></li>-->
                    </ul>
                </div>
            </li>
            <li class="has-inner">
                <div>
                    <a href="{{ route('cabinet.dialog.index') }}">
                        <span>Сообщения</span>
                    </a>
                    <span class="badge">4</span>
                </div>
            </li>
            <!--<li class="has-inner">
                <div>
                    <a href="#my-favourites" data-toggle="collapse" class="collapse collapsed">
                        <span>Избранное</span>
                        <span><i class="glyphicon glyphicon-menu-right"></i><i class="glyphicon glyphicon-menu-down"></i></span>
                    </a>
                </div>
                <div class="collapse" id="my-favourites">
                    <ul>
                        <li><a href="#">Товары</a></li>
                        <li><a href="#">Продавцы</a></li>
                    </ul>
                </div>
            </li>
            <li><div><a href="#">Отзывы</a></div></li>-->
            <li {!! (isset($profileActive) and $profileActive) ? "class='has-inner active'" : '' !!}><div><a href="{{ route('cabinet.profile') }}">Профиль</a></div></li>
            <li {!! (isset($settingsActive) and $settingsActive) ? "class='has-inner active'" : '' !!}><div><a href="{{ route('cabinet.settings.index') }}">Настройки</a></div></li>
        </ul>
    </nav>
</div>