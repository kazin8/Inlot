@if (count($cars))
@foreach ($cars as $car)
<div class="col-xs-12 col-sm-4 col-md-4">
    <div class="Product-item bordered border-radius">
        <a href="{{ route('goods.item', ['goods' => $car->goods->id]) }}" class="Product-item-link"></a>
        <div class="Product-item-header">
            <a href="{{ route('goods.item', ['goods' => $car->goods->id]) }}"><img src="{{ $car->goods->imagePath }}" alt=""></a>
        </div>
        <div class="Product-item-content">
            <p class="name"><a href="{{ route('goods.item', ['goods' => $car->goods->id]) }}">{{ $car->goods->name }}</a></p>
            <p class="price">{{ $car->goods->priceFormat }} ₽</p>
        </div>
        <div class="Product-item-footer">
            <p>{{ $car->date_release_id }}, {{ $car->run }} км</p>
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