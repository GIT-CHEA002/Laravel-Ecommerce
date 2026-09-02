<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index()
    {
        $cart = Cart::with('cartItems.')->get()->groupBy('cart_id');
        return $cart;
    }
    public function store(Product $product)
    {
        // Find existing cart or create a new one
        $cart = Cart::firstOrFail();

        // Check if this product already exists in the cart
        $cartItem = CartItem::where('cart_id', $cart->cart_id)
            ->where('product_id', $product->product_id)
            ->first();

        if ($cartItem) {

            // Product already exists → increase quantity
            $cartItem->increment('quantity');
        } else {

            // Product doesn't exist → create new cart item
            CartItem::create([
                'cart_id' => $cart->cart_id,
                'product_id' => $product->product_id,
                'quantity' => 1,
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Product added to cart.');
    }
    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Make sure this cart item belongs to the logged-in user
        if ($cartItem->cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Cart updated.');
    }

    public function destroy(CartItem $cartItem)
    {
        // Make sure this cart item belongs to the logged-in user
        if ($cartItem->cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()
            ->back()
            ->with('success', 'Product removed from cart.');
    }
    public function clear()
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        if ($cart) {
            $cart->cartItems()->delete();
        }

        return redirect()
            ->back()
            ->with('success', 'Cart cleared.');
    }
}
