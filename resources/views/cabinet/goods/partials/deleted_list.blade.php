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
    
    <div class="product-item-vertical--content">
        <div class="product-item-vertical--img">
            <img src="{{ $product->imagePath }}" alt="" class="full-width">
        </div>
        <div class="product-item-vertical--description">
            <div>
                <div class="product-item-vertical--name"><p>{{ $product->name }}</p></div>
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
                <div><a href class="red restore-goods" data-code="deleted_list" data-url="{{ route('cabinet.goods.restore', ['goods' => $product->id]) }}">Восстановить товар</a></div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif