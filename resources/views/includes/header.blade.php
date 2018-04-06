<!-- header -->
<section class="header">
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><img src="/assets/img/logo.png" alt=""></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav bordered">
                    <li><p>ТОРГОВАЯ<br>ПЛОЩАДКА</p></li>
                    <li>
                        <div class="icon location my-flex">
                            <div><i class="fa fa-map-marker"></i></div>
                            <div><p>Санкт-Петербург</p></div>
                        </div>
                    </li>
                    <!--<li>
                        <p class="number"><a href="tel:8 (800) 123-34-45">8 (800) 123-34-45</a></p>
                    </li>-->
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    @if (Auth::check())
                    <li>
                        <div class="User-shortcut dropdown">
                            <a href="{{ route('cabinet') }}" class="User-shortcut-img" data-item="dropdown">
                                <img src="{{ Auth::user()->image30Path }}" alt="..." class="img-circle">
                                <p>Личный кабинет</p>
                            </a>
                            <a href="#" data-item="click-dropdown" class="User-shortcut-link"><i class="fa fa-sort-desc"></i></a>
                            <ul class="dropdown-menu">
                                <li class="User-shortcut-name"><p>{{ Auth::user()->name }}</p></li>
                                @if (Auth::user()->type == 2)
                                    <li class="User-shortcut-company"><p>{{ Auth::user()->companyName }}</p></li>
                                @endif
                                    <li class="divider"></li>
                                @if (Auth::user()->type == 2)
                                    <li><p><a href="{{ route('cabinet.goods.fullList') }}">Мои товары</a></p></li>
                                @endif
                                <li><p><a href="{{ route('cabinet.orders') }}">Покупки</a></p></li>
                                @if (Auth::user()->type == 2)
                                    <li><p><a href="{{ route('cabinet.sales') }}">Продажи</a></p></li>
                                @endif
                                <li><p><a href="{{ route('cabinet.dialog.index') }}">Сообщения</a></p></li>
                                <li><p><a href="{{ route('cabinet.settings.index') }}">Настройки</a></p></li>
                                <li><a class="btn btn-default btn-block text-center" href="{{ url('/logout') }}">Выйти</a></li>
                            </ul>
                        </div>
                    </li>
                    @else
                    <li><a href="{{ url('/login') }}" class="LogIn icon my-flex"><div><i></i></div><div><p>Войти</p></div></a></li>
                    <li><a href="{{ url('/register') }}" class="btn btn-orange">Зарегистрироваться</a></li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</section>
<!-- header END -->