<p>Уважаемый {{ $name }},</p>

<p>@lang('order_created.your_order') {{ $fullSum }} {{ \App\Services\CurrencyConversion::getCurrencySymbol() }} создан</p>

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
            <span class="badge">{{ $product->countInOrder }}</span>
            <div class="btn-group form-inline">
                {{ $product->description }}
            </div>
        </td>
        <td>{{ $product->price }} {{ \App\Services\CurrencyConversion::getCurrencySymbol() }}</td>
        <td>{{ $product->getPriceForCount() }} {{ \App\Services\CurrencyConversion::getCurrencySymbol() }}</td>
    @endforeach
    </tbody>
</table>
