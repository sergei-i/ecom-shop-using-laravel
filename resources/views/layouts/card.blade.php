<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @if($product->isNew())
                <span class="badge badge-success">Новинка</span>
            @endif
            @if($product->isRecommend())
                <span class="badge badge-warning">Рекомендуемые</span>
            @endif
            @if($product->isHit())
                <span class="badge badge-danger">Хит продаж</span>
            @endif
        </div>
        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->__('name') }}">
        <div class="caption">
            <h3>{{ $product->__('name') }}</h3>
            <p>{{ $product->price }} {{ $currencySymbol }}</p>
            <form action="{{ route('basket-add', $product) }}"
                  method="POST"> <?php //можно не $product-> id, тк по умолчанию возьмет id ?>
                @csrf
                @if($product->isAvailable())
                <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                @else
                    Недоступен
                @endif
                <a href="{{ route('product', [isset($category) ? $category->code: $product->category->code, $product->code]) }}"
                   class="btn btn-default"
                   role="button">Подробнее</a>
            </form>
        </div>
    </div>
</div>

