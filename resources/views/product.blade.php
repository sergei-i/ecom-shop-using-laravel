@extends('layouts.master')

@section('title', 'Товар')

@section('content')
    <h1>{{ $product->name }}</h1>
    <h2>{{ $product->category->name }}</h2>
    <p>Цена: <b>{{ $product->price }} {{ \App\Services\CurrencyConversion::getCurrencySymbol() }}</b></p>
    <img src="{{ Storage::url($product->image) }}" height="250px">
    <p>{{ $product->description }}</p>

    @if($product->isAvailable())
        <form action="{{ route('basket-add', $product) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>
        </form>
    @else
        <span><b>Недоступен</b></span>
        <br>
        <span>Сообщить мне, когда товар появится в наличии:</span>

        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <form action="{{ route('subscription', $product) }}" method="post">
            @csrf
            <input type="text" name="email">
            <button type="submit" class="btn btn-default">Отправить</button>
        </form>
    @endif
@endsection
