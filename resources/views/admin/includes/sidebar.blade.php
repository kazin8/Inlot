<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="/dashboard/upload/user.jpg" class="img-circle" alt="{{ Auth::user()->name }}">
        </div>
        <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> В сети</a>
        </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">Меню</li>
        <li>
            <a href="{{ route('pages.index') }}">
                <i class="fa fa-th"></i>
                <span>Страницы</span>
                <small class="label pull-right bg-green">25</small>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.handbooks.index') }}">
                <i class="fa fa-user"></i>
                <span>Справочники</span>
                <small class="label pull-right bg-green"></small>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.administrators.index') }}">
                <i class="fa fa-user"></i>
                <span>Администраторы</span>
                <small class="label pull-right bg-green"></small>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}">
                <i class="fa fa-user"></i>
                <span>Пользователи</span>
                <small class="label pull-right bg-green"></small>
            </a>
        </li>
    </ul>
</section>
<!-- /.sidebar -->