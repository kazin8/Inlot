@extends('layouts.cabinet')

@section('title', 'Личный кабинет — Мои товары — Черновики — Inlot.ru')

@section('content')
<!-- content  -->
<section class="content">
    <div class="container">
        <!--title and description-->
        <div class="row">

            @include('includes.left_menu')

            <div class="col-xs-12 col-md-9 col-sm-9">
                <div class="Settings-header">
                    <h1>Черновики</h1>
                </div>
                {{ Form::hidden('listCode', 'draft_list', ['class' => 'goods-list-code']) }}
                
                @include('includes/cabinet_goods_filter')

                <hr>
                <div class="alert alert-orange alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="alert-title">
                        <div><i class="fa fa-info-circle" aria-hidden="true"></i></div>
                        <div><p>Заполните все данные, чтобы начать продавать</p></div>
                    </div>
                    <p>Метафора, несмотря на то, что все эти характерологические черты отсылают не к единому образу нарратора, просветляет возврат к стереотипам.</p>
                </div>

                <div id="result-list">
                    @include('cabinet.goods.partials.draft_list')
                </div>

                @if (count($goods))
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