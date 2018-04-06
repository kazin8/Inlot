@if (count($orders))
@foreach ($orders as $order)
<div class="product-item-vertical">
    <div class="product-item-vertical--settings">
        <div class="checkbox">
            <label>
                <input type="checkbox" />
            </label>
        </div>
        <div>
            <button type="button" class="tap-bar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
    </div>
    <div class="product-item-vertical--content">
        <div class="product-item-vertical--img">
            <a href="{{ route('orders.item', ['orders' => $order->id]) }}"><img src="{{ $order->goods->imagePath }}" alt="" class="full-width"></a>
        </div>
        <div class="product-item-vertical--description">
            <div>
                <div class="product-item-vertical--name"><p><a href="{{ route('orders.item', ['orders' => $order->id]) }}">{{ $order->goods->name }}</a></p></div>
                <div class="product-item-vertical--price"><p>{{ $order->goods->priceFormat }} ₽</p></div>
                <div class="product-item-vertical--place">
                    <div>
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                    </div>
                    <div>
                        <p>{{ $order->goods->city->name }}</p>
                        <p>{{ $order->userCustomer->companyName }}</p>
                        <p>{{ $order->userCustomer->name }}</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="product-item-vertical--date">
                    <div><p>{{ $order->created_at }}</p></div>
                    <div><p><span class="badge">{{ \App\Order::$statusNamesOwner[$order->status] }}</span></p></div>
                </div>
            </div>
        </div>
        <div class="product-item-vertical--actions">
            <div><a href="#">Написать покупателю</a></div>
            <div><a href="#" class="call-status-modal" data-toggle="modal" data-target="#changeStatusType" data-id="{{ $order->id }}">Изменить статус</a></div>
        </div>
    </div>
</div>
@endforeach
@endif