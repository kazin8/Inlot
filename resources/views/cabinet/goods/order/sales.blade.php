@extends('layouts/cabinet')

@section('title', 'Личный кабинет — Продажи — Мои продажи — Inlot.ru')

@section('content')
<!-- content  -->
<section class="content">
    <div class="container">
        <!--title and description-->
        <div class="row">

            @include('includes.left_menu')

            <div class="col-xs-12 col-md-9 col-sm-9">
                <div class="Settings-header">
                    <h1>Продажи</h1>
                </div>
                {{ Form::hidden('listCode', 'sales', ['class' => 'goods-list-code']) }}

                <hr>

                <div id="result-list">
                    @include('cabinet/goods/order/partials/sales', ['orders' => $sales])
                </div>

                @if (count($sales))
                    <div id="pagination-block">
                        {!! $paginationBlock !!}
                    </div>
                @endif

            </div>
        </div><!-- title end -->
    </div>
</section>
<!-- content END -->
@include('modals/change_order_status')
@endsection