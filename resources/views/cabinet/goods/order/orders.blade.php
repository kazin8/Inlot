@extends('layouts/cabinet')

@section('title', 'Личный кабинет — Покупки — Мои заказы — Inlot.ru')

@section('content')
<!-- content  -->
<section class="content">
    <div class="container">
        <!--title and description-->
        <div class="row">

            @include('includes.left_menu')

            <div class="col-xs-12 col-md-9 col-sm-9">
                <div class="Settings-header">
                    <h1>Покупки</h1>
                </div>
                {{ Form::hidden('listCode', 'orders', ['class' => 'goods-list-code']) }}

                <hr>

                <div id="result-list">
                    @include('cabinet.goods.order.partials.orders', ['orders' => $orders])
                </div>

                @if (count($orders))
                    <div id="pagination-block">
                        {!! $paginationBlock !!}
                    </div>
                @endif

            </div>
        </div><!-- title end -->
    </div>
</section>
<!-- content END -->
@endsection