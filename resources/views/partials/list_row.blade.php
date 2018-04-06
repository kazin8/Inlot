@if (count($products))
@foreach ($products as $product)
<div class="product-item-vertical" data-item="product">
    <a class="product-item-vertical--link" href="{{ route('goods.item', ['goods' => $product->id]) }}"></a>
    <div class="product-item-vertical--content">
        <div class="product-item-vertical--img">
            <a href="{{ route('goods.item', ['goods' => $product->id]) }}"><img src="{{ $product->imagePath }}" alt="" class="full-width"></a>
        </div>
        <div class="product-item-vertical--description">
            <div>
                <div class="product-item-vertical--name"><p><a href="{{ route('goods.item', ['goods' => $product->id]) }}">{{ $product->name }}</a></p></div>
                <div class="product-item-vertical--price"><p>{{ $product->priceFormat }} ₽</p></div>
                <div class="product-item-vertical--buy-now"><p>Купить сейчас</p></div>
            </div>
            <div>
                <div class="product-item-vertical--info">
                    @include('partials/' . $product->category->code . '/add_info', ['unit' => $product->unit])
                </div>
            </div>
        </div>
        <div class="product-item-vertical--actions flex">
            <div class="width flex">
                <div>
                    <div class="from">
                        <div><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                        <div><p>{{ $product->city->name }}</p></div>
                    </div>
                    <div class="who">
                        <div><a href="#">{{ $product->companyName }}</a></div>
                        <div><p>Компания</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- product END-->
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