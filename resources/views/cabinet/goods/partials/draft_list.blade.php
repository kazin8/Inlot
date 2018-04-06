@if ($goods)
@foreach ($goods as $product)
<div class="product-item-vertical goods-{{ $product->id }}" data-item="product">
    <!-- <div class="product-item-vertical--settings">
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
    </div> -->
    <a class="product-item-vertical--link" href="{{ route('cabinet.goods.edit', ['goods' => $product->id, 'step' => 2]) }}"></a>
    <div class="product-item-vertical--content">
        <div class="product-item-vertical--img">
            <img src="{{ $product->imagePath }}" alt="" class="full-width">
        </div>
        <div class="product-item-vertical--description">
            <div>
                <div class="product-item-vertical--name"><p><a href="{{ route('cabinet.goods.edit', ['goods' => $product->id, 'step' => 2]) }}">{{ $product['name'] }}</a></p></div>
                @if ($product->price)
                <div class="product-item-vertical--price"><p>{{ $product->priceFormat }} ₽</p></div>
                <div class="product-item-vertical--buy-now"><p>Купить сейчас</p></div>
                @endif

            </div>
            <div>
                <div class="product-item-vertical--info">
                    @include('partials/' . $product->category->code . '/add_info', ['unit' => $product->unit])
                </div>
            </div>
        </div>
        <div class="product-item-vertical--actions">
            <div class="width">
                <div><a href="{{ route('cabinet.goods.edit', ['goods' => $product->id, 'step' => 2]) }}">Редактировать</a></div>
                <div><a href class="red delete-goods" data-code="draft_list" data-url="{{ route('cabinet.goods.destroy', ['goods' => $product->id]) }}">Удалить товар</a></div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif