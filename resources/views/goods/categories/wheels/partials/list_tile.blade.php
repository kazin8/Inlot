@if (count($wheels))
@foreach ($wheels as $wheel)
<div class="col-xs-12 col-sm-4 col-md-4">
    <div class="Product-item bordered border-radius">
        <a href="{{ route('goods.item', ['goods' => $wheel->goods->id]) }}" class="Product-item-link"></a>
        <div class="Product-item-header">
            <a href="{{ route('goods.item', ['goods' => $wheel->goods->id]) }}"><img src="{{ $wheel->goods->imagePath }}" alt=""></a>
        </div>
        <div class="Product-item-content">
            <p class="name"><a href="{{ route('goods.item', ['goods' => $wheel->goods->id]) }}">{{ $wheel->goods->name }}</a></p>
            <p class="price">{{ $wheel->goods->priceFormat }} ₽</p>
        </div>
        <div class="Product-item-footer">

        </div>
    </div>
</div>
@endforeach
@else
<!-- результаты поиска\сортировки-->
<div class="product-item-filter--result-search">
    <div class="col-xs-12">
        <p>
            Нет товаров по вашим критериям.
        </p>
    </div>
</div><!-- результаты поиска\сортировки END-->
@endif