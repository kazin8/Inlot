@if (count($tires))
<div class="col-xs-12 col-sm-12 col-md-12">
    @foreach ($tires as $tire)
    <!-- product -->
    <div class="product-item-vertical" data-item="product">
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
        <a class="product-item-vertical--link" href="{{ route('goods.item', ['goods' => $tire->goods->id]) }}"></a>
        <div class="product-item-vertical--content">
            <div class="product-item-vertical--img">
                <a href="{{ route('goods.item', ['goods' => $tire->goods->id]) }}"><img src="{{ $tire->goods->imagePath }}" alt="" class="full-width"></a>
            </div>
            <div class="product-item-vertical--description">
                <div>
                    <div class="product-item-vertical--name"><p><a href="{{ route('goods.item', ['goods' => $tire->goods->id]) }}">{{ $tire->goods->name }}</a></p></div>
                    <div class="product-item-vertical--price"><p>{{ $tire->goods->priceFormat }} ₽</p></div>
                    <div class="product-item-vertical--buy-now"><p>Купить сейчас</p></div>
                </div>
                <div>
                    <div class="product-item-vertical--info">

                    </div>
                </div>
            </div>
            <div class="product-item-vertical--actions flex">
                <div class="width flex">
                    <div>
                        <div class="from">
                            <div><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                            <div><p>{{ $tire->goods->city->name }}</p></div>
                        </div>
                        <div class="who">
                            <div><a href>{{ $tire->goods->companyName }}</a></div>
                            <div><p>Компания</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- product END-->
    @endforeach
</div>
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