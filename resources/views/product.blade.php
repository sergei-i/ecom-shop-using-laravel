@extends('layouts.master')

@section('title', 'Товар')

@section('content')
    <h1>{{ $product->name }}</h1>
    <h2>{{ $product->category->name }}</h2>
    <p>Цена: <b>{{ $product->price }} ₽</b></p>
    <img src="{{ Storage::url($product->image) }}" height="250px">
    <p>{{ $product->description }}b</p>
    <form action="{{ route('basket-add', $product) }}"
          method="POST">
        @csrf
        @if($product->isAvailable())
            <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>
        @else
            Недоступен
        @endif
    </form>
    {{--    <span>product.not_available</span>--}}
    {{--    <br>--}}
    {{--    <span>Сообщить мне, когда товар появится в наличии:</span>--}}
    {{--    <div class="warning">--}}
    {{--    </div>--}}
    {{--    <form method="POST" action="http://internet-shop.tmweb.ru/subscription/1">--}}
    {{--        <input type="hidden" name="_token" value="j2pjQVKtNc2VXrMXZ3h6Lq6kyud5DY628pQavdiX">--}}
    {{--        <input type="text"name="email"></input>--}}
    {{--        <button type="submit">Отправить</button>--}}
    {{--    </form>--}}
@endsection
