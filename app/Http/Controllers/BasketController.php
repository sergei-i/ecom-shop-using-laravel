<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        $order = (new Basket())->getOrder();
        return view('basket', compact('order'));
    }

    public function basketPlace()
    {
        $basket = new Basket();
        $order = $basket->getOrder();
        if (!$basket->countAvailable()) {
            session()->flash('warning', 'Товар в большем количестве не доступен для заказа');
            return redirect()->route('basket');
        }
        return view('order', compact('order'));
    }

    public function basketAdd(Product $product)
    {
        $result = (new Basket(true))->addProduct($product);

        if ($result) {
            session()->flash('success', 'Товар "' . $product->name . '" добавлен в корзину');
        } else {
            session()->flash('warning', 'Товар "' . $product->name . '" в большем количестве не доступен для заказа');
        }

        return redirect()->route('basket'); //избавляет от выполнения такого же действия при обновлении страницы
    }

    public function basketRemove(Product $product)
    {
        (new Basket())->removeProduct($product);

        session()->flash('warning', 'Товар "' . $product->name . '" удален из корзины');

        return redirect()->route('basket'); //избавляет от выполнения такого же действия при обновлении страницы
    }

    public function basketConfirm(Request $request)
    {
        $email = Auth::check() ? Auth::user()->email : $request->email;
        $success = (new Basket())->saveOrder($request->name, $request->phone, $email);

        if ($success) {
            session()->flash('success', __('basket.your_order_confirmed'));
        } else {
            session()->flash('warning', 'Товар в большем количестве не доступен для заказа');
        }

        Order::eraseOrderSum();
        return redirect()->route('index');
    }
}
