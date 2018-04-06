<!DOCTYPE html>
<html lang="ru_RU">
<head>
    @include('includes.head')
</head>
<body>
<!-- sticky -->
<div class="sticky-page">

    @include('includes.header')

    @yield('content')

</div>

@include('includes.footer')

@include('includes.epilog')
</body>
</html>
