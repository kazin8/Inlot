<!DOCTYPE html>
<html>
<head>
    @include('admin.includes.head')
</head>
<body class="hold-transition skin-green-light sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        @include('admin.includes.header')
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        @include('admin.includes.sidebar')
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('content')
    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
        @include('admin.includes.footer')
    </footer>

</div><!-- ./wrapper -->

@include('admin.includes.epilog')

</body>
</html>
