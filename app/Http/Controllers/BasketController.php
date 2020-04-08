<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }
        return view('basket', compact('order'));
    }

    public function basketPlace()
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        return view('order', compact('order'));
    }

    public function basketAdd($productId)
    {
        $orderId = session('orderId');

        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($productId)) {
            $pivotRaw = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRaw->count++;
            $pivotRaw->update();
        } else {
            $order->products()->attach($productId);
        }

        $product = Product::find($productId);
        session()->flash('success', 'Товар "' . $product->name . '" добавлен в корзину');

        return redirect()->route('basket'); //избавляет от выполнения такого же действия при обновлении страницы
    }

    public function basketRemove($productId)
    {
        $orderId = session('orderId');

        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);

        if ($order->products->contains($productId)) {
            $pivotRaw = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRaw->count < 2) {
                $order->products()->detach($productId);
            } else {
                $pivotRaw->count--;
                $pivotRaw->update();
            }
        }
        $product = Product::find($productId);
        session()->flash('warning', 'Товар "' . $product->name . '" удален');

        return redirect()->route('basket'); //избавляет от выполнения такого же действия при обновлении страницы
    }

    public function basketConfirm(Request $request)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        $success = $order->saveOrder($request->name, $request->phone);
        if ($success) {
            session()->flash('success', 'Ваш заказ принят в обработку!');
        } else {
            session()->flash('warning', 'Случилась ошибка');
        }
        return redirect()->route('index');
    }
}