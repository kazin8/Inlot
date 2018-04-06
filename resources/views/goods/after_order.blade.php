@extends('layouts.site')

@section('title', 'Заказ успешно оформлен — Inlot.ru')

@section('content')
<!-- content  -->
<section class="content">
    <div class="container">
        <!--title and description-->
	<div class="row">
            <div class="col-xs-12 col-md-12 col-sm-12">
		<div class="Settings-header">
		<h1>Заказ оформлен, спасибо!</h1>
		<h2>Заказ № {{ $order->id }} от {{ $order->date }}</h2>
            </div>
            <div class="Order-status">
		<div><p>Статус:</p></div>
		<div><p class="badge badge-yellow">{{ \App\Order::$statusNamesCustomer[$order->status] }}</p></div>
            </div>
            <!-- form -->
            <form action="" class="Order" data-item="order-cards">
		<div class="row">
                    <div class="col-xs-12 col-sm-9 col-md-9">
			<!-- product-->
			<div>
                            <p>Состав заказа</p>
			</div>
			<div class="product-item-vertical" data-item="product">
                            <div class="product-item-vertical--content">
				<div class="product-item-vertical--img">
                                    <a href="{{ route('goods.item', ['goods' => $order->goods->id]) }}"><img src="{{ $order->goods->imagePath }}" alt="" class="full-width"></a>
				</div>
				<div class="product-item-vertical--description">
                                    <div>
					<div class="product-item-vertical--name"><p><a href="{{ route('goods.item', ['goods' => $order->goods->id]) }}">{{ $order->goods->name }}</a></p></div>
					<div class="product-item-vertical--price"><p>{{ $order->goods->priceFormat }} ₽</p></div>
                                    </div>
                                    <div>
					<div class="product-item-vertical--info">
                                            @include('partials/' . $order->goods->category->code . '/add_info', ['unit' => $order->goods->unit])
					</div>
                                    </div>
				</div>
                            </div>
			</div><!-- product END-->
                        <div class="row">
                            <div class="col-xs-12 col-sm-9 col-md-9">
                                <div class="Order-total-block">
                                    <div class="total">
                                        <p class="total-title">Сумма заказа</p>
					<p class="total-price">{{ $order->goods->priceFormat }} ₽</p>
                                    </div>
                                    <address class="contact-saller">
					<p>Контакты продавца</p>
					<p class="contact-saller-name">{{ $order->goods->user->name }}</p>
                                        <p class="contact-saller-phone"><a href="tel:{{ $order->goods->user->phone }}">{{ $order->goods->user->phone }}</a></p>
					<p class="contact-saller-mail"><a href="mailto:{{ $order->goods->user->email }}">{{ $order->goods->user->email }}</a></p>
                                        <p class="contact-saller-address">{{ $order->goods->user->region }}, {{ $order->goods->user->city }}</p>
                                    </address>
                                    <div class="comment">
                                        <p class="comment-title">Комментарий</p>
                                        <p class="comment-description">{{ $order->comment }}</p>
                                    </div>
				</div>
                            </div>
			</div>
			<div class="row">
                            <div class="col-xs-12 col-sm-9 col-md-9">
				<!--<button type="button" class="btn btn-orange" data-item="print">Распечатать</button>-->
				<button type="button" class="btn btn-orange" data-toggle="modal" data-target="#callSeller">Написать продавцу</button>
                            </div>
			</div>
			<!-- will remove this -->
			<div class="row">
                            <div class="col-xs-12 col-sm-9 col-md-9">
				<br>
                            </div>
			</div><!-- will remove this -->
                    </div>
                </form><!-- form -->
            </div>
	</div><!-- title end -->
    </div>
</section>

@include('modals/seller-call')
<!-- content END -->
@endsection