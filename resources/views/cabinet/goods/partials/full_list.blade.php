@if ($goods)
@foreach ($goods as $product)
<div class="product-item-vertical goods-{{ $product->id }}" data-item="product">
    
    <div class="product-item-vertical--content">
        @if ($product->status == 6)
        <a class="product-item-vertical--link" href="{{ route('goods.item', ['goods' => $product->id]) }}"></a>
        @endif
        <div class="product-item-vertical--img">
            @if ($product->status == 6)
            <a href="{{ route('goods.item', ['goods' => $product->id]) }}">
                <img src="{{ $product->imagePath }}" alt="" class="full-width">
            </a>
            @else
            <a href="#" class="disabled">
                <img src="{{ $product->imagePath }}" alt="" class="full-width">
            </a>
            @endif
        </div>
        <div class="product-item-vertical--description">
            <div>
                <div class="product-item-vertical--name"><p><a href="{{ $product->status == 6 ? route('goods.item', ['goods' => $product->id]) : route('cabinet.goods.edit', ['goods' => $product->id, 'step' => 4]) }}">{{ $product->name }}</a></p></div>
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
                    @if ($product->status == 6)
                    <div><p class="badge badge-orange">В продаже</p></div>
                    @elseif ($product->status == 5)
                    <div><p class="badge badge-default">Снят с продажи</p></div>
                    @elseif ($product->status == 7)
                    <div><p class="badge badge-default">Сделка оформляется</p></div>
                    @endif
                </div>
                <div><a href="{{ route('cabinet.goods.edit', ['goods' => $product->id, 'step' => 2]) }}">Редактировать</a></div>
                <div class="goods-status-link-{{ $product->id }}">
                    @if ($product->status == 6)
                    <a href class="disactivate-goods" data-code="full_list" data-id="{{ $product->id }}" data-url="{{ route('cabinet.goods.disactivate', ['goods' => $product->id]) }}" data-reverse-url="{{ route('cabinet.goods.activate', ['goods' => $product->id]) }}">Снять с продажи</a>
                    @elseif ($product->status == 5)
                    <a href class="activate-goods" data-code="full_list" data-id="{{ $product->id }}" data-url="{{ route('cabinet.goods.activate', ['goods' => $product->id]) }}" data-reverse-url="{{ route('cabinet.goods.disactivate', ['goods' => $product->id]) }}">В продажу</a>
                    @endif
                </div>
                <div><a href class="red delete-goods" data-code="full_list" data-url="{{ route('cabinet.goods.destroy', ['goods' => $product->id]) }}">Удалить товар</a></div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif