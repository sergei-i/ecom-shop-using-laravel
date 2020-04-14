<p>Уважаемый {{ $name }},</p>

<p>@lang('mail.order_created.your_order') {{ $fullSum }} ₽ создан</p>

<table>
    <tbody>
    @foreach($order->products as $product)
        <td>
            <a href="{{ route('product', [$product->category->code, $product->code]) }}">
                <img height="56px"
                     src="{{ Storage::url($product->image) }}">
                {{ $product->name }}
            </a>
        </td>
        <td>
            <span class="badge">{{ $product->pivot->count }}</span>
            <div class="btn-group form-inline">
                {{ $product->description }}
            </div>
        </td>
        <td>{{ $product->price }} ₽</td>
        <td>{{ $product->getPriceForCount() }} ₽</td>
    @endforeach
    </tbody>
</table>
