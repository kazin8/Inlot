<!DOCTYPE html>
<html lang="ru_RU">
<head>
    @include('includes.head')
</head>
<body>
    <!-- sticky -->
    <div class="sticky-page">

        @include('includes.header')
        
        @include('includes.search_block')

        @include('includes.cat_menu')

        @yield('content')

    </div>

    @include('includes.footer')

    @include('includes.epilog')
</body>
</html>
