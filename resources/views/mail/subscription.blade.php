Уважаемый клиент, товар {{ $product->name }} доступен для заказа.

<a href="{{ route('product', [$product->category->code, $product->code]) }}">Узнать подробности</a>
