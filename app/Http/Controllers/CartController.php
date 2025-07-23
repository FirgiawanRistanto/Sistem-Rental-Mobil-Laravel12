<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $productId = $request->id;
        $product = Product::findOrFail($productId);
        
        $cart = session()->get('cart', []);

        if(isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        
        session()->put('cart', $cart);
        return response()->json(['success' => 'Product added to cart successfully!']);
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return response()->json(['success' => 'Cart updated successfully']);
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return response()->json(['success' => 'Product removed successfully']);
        }
    }

    public function checkout(Request $request)
    {
        $selectedProductIds = $request->input('selected_products', []);
        $cart = session()->get('cart', []);
        $filteredCart = [];
        $total = 0;

        foreach ($cart as $id => $details) {
            if (in_array($id, $selectedProductIds)) {
                $filteredCart[$id] = $details;
                $total += $details['price'] * $details['quantity'];
            }
        }

        return view('cart.checkout', ['cart' => $filteredCart, 'total' => $total]);
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|string',
            'selected_products' => 'required|array',
            'selected_products.*' => 'exists:products,id', // Ensure selected product IDs exist
        ]);

        $selectedProductIds = $request->input('selected_products');
        $cart = session()->get('cart', []);
        $productsToOrder = [];
        $totalAmount = 0;

        foreach ($cart as $id => $details) {
            if (in_array($id, $selectedProductIds)) {
                $productsToOrder[$id] = $details;
                $totalAmount += $details['price'] * $details['quantity'];
            }
        }

        if (empty($productsToOrder)) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada produk yang dipilih untuk checkout.');
        }

        // Create the order
        $order = \App\Models\Order::create([
            'user_id' => auth()->id(), // Assuming user is logged in
            'total_amount' => $totalAmount,
            'address' => $request->address,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        // Add order items and remove from session cart
        foreach ($productsToOrder as $id => $details) {
            $order->orderItems()->create([
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
            // Remove the ordered item from the session cart
            unset($cart[$id]);
        }
        session()->put('cart', $cart); // Update the session cart

        return redirect()->route('order.success')->with('success', 'Pesanan Anda berhasil ditempatkan!');
    }
}