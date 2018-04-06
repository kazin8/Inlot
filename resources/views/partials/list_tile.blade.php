@if (count($products))
@foreach ($products as $product)
<div class="col-xs-12 col-sm-4 col-md-4">
    <div class="Product-item bordered border-radius">
        <a href="{{ route('goods.item', ['goods' => $product->id]) }}" class="Product-item-link"></a>
        <div class="Product-item-header">
            <a href="{{ route('goods.item', ['goods' => $product->id]) }}"><img src="{{ $product->imagePath }}" alt=""></a>
        </div>
        <div class="Product-item-content">
            <p class="name"><a href="{{ route('goods.item', ['goods' => $product->id]) }}">{{ $product->name }}</a></p>
            <p class="price">{{ $product->priceFormat }} ₽</p>
        </div>
        <div class="Product-item-footer">
            @include('partials/' . $product->category->code . '/add_info', ['unit' => $product->unit])
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

@section('pagination')
Pagination tile
@endsection