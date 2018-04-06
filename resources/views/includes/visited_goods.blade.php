@if (count($visitedGoods))
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h2 class="reset-top Product-item--title">Вы уже смотрели</h2>
        </div>
    </div>
    <div class="row Product-item-grid">
        @foreach ($visitedGoods as $product)
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="Product-item horizontal horizontal-center bordered border-radius m-top">
                    <a href="{{ route('goods.item', ['goods' => $product->id]) }}" class="Product-item-link"></a>
                    <div class="Product-item-header">
                        <a href="{{ route('goods.item', ['goods' => $product->id]) }}"><img src="{{ $product->imagePath }}" alt=""></a>
                    </div>
                    <div class="Product-item-content">
                        <p class="name"><a href="{{ route('goods.item', ['goods' => $product->id]) }}">{{ $product->name }}</a></p>
                        <p class="price">{{ $product->priceFormat }} ₽</p>
                    </div>
                    <div class="Product-item-footer">

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <a href="#" class="all-lots">Вся история просмотров</a>
        </div>
    </div>
@endif