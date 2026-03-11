<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Basket;

class OrderController extends Controller
{
    /**
     * Display the user's order history
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
                       ->with('items')
                       ->orderBy('created_at', 'desc')
                       ->get();

        return view('pages.orders.index', compact('orders'));
    }

    /**
     * Show single order details
     */
    public function show($id)
    {
        $order = Order::where('user_id', auth()->id())
                      ->with('items')
                      ->findOrFail($id);

        return view('pages.orders.show', compact('order'));
    }

    /**
     * To create order from basket
     */
    public function store(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'postcode' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $basketItems = Basket::where('user_id', auth()->id())->get();

        if ($basketItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your basket is empty');
        }

        foreach ($basketItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return back()->withErrors([
                    'stock' => "Not enough stock for {$item->product->name}, please check again later."
                ]);
            }
        }

        $total = $basketItems->sum(fn($item) => $item->product->price * $item->quantity);

        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'status' => 'pending',
            'shipping_address' => $request->address,
            'city' => $request->city,
            'postcode' => $request->postcode,
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'payment_method' => $request->payment_method,
        ]);

        foreach ($basketItems as $item) {
            $product = $item->product;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image_url,
                'quantity' => $item->quantity,
            ]);

            $product->decrement('stock', $item->quantity);
        }

        Basket::where('user_id', auth()->id())->delete();

        return redirect()->route('orders.show', $order->id)
                         ->with('success', 'Order placed successfully');
    }
}