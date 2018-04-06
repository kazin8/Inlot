@if ($goods)
@foreach ($goods as $product)
<div class="product-item-vertical goods-{{ $product->id }}" data-item="product">
    <a class="product-item-vertical--link" href="{{ route('goods.item', ['goods' => $product->id]) }}"></a>
    <div class="product-item-vertical--content">
        <div class="product-item-vertical--img">
            <a href="{{ route('goods.item', ['goods' => $product->id]) }}">
                <img src="{{ $product->imagePath }}" alt="" class="full-width">
            </a>
        </div>
        <div class="product-item-vertical--description">
            <div>
                <div class="product-item-vertical--name"><p><a href="#">{{ $product->name }}</a></p></div>
                <div class="product-item-vertical--price"><p>{{ $product->priceFormat }} ₽</p></div>
                <div class="product-item-vertical--buy-now"><p>Купить сейчас</p></div>

            </div>
            <div>
                <div class="product-item-vertical--info">
                    @include('partials/' . $product->category->code . '/add_info', ['unit' => $product->unit])
                </div>
            </div>
        </div>
        <div class="product-item-vertical--actions">
            <div class="width">
                <div class="goods-status-{{ $product->id }}">
                    <div><p class="badge badge-orange">В продаже</p></div>
                </div>
                <div><a href="{{ route('cabinet.goods.edit', ['goods' => $product->id, 'step' => 2]) }}">Редактировать</a></div>
                <div class="goods-status-link-{{ $product->id }}">
                    <a href class="disactivate-goods" data-code="on_sale_list" data-id="{{ $product->id }}" data-url="{{ route('cabinet.goods.disactivate', ['goods' => $product->id]) }}" data-reverse-url="{{ route('cabinet.goods.activate', ['goods' => $product->id]) }}">Снять с продажи</a>
                </div>
                <div><a href class="red delete-goods" data-code="on_sale_list" data-url="{{ route('cabinet.goods.destroy', ['goods' => $product->id]) }}" data-item="delete">Удалить товар</a></div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif