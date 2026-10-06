<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Get the logged-in user's cart, creating an empty one if needed
    private function currentCart(): Cart
    {
        return Cart::firstOrCreate(['user_id' => Auth::user()->user_id]);
    }

    public function index()
    {
        $cart = $this->currentCart();

        return view('client.cart.index', [
            'carts' => $cart->cartItems()->with('product')->get(),
        ]);
    }

    public function store(Product $product)
    {
        $cart = $this->currentCart();

        $cartItem = CartItem::where('cart_id', $cart->cart_id)
            ->where('product_id', $product->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'cart_id'    => $cart->cart_id,
                'product_id' => $product->product_id,
                'quantity'   => 1,
            ]);
        }

        return back()->with('success', 'Product added to cart.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        abort_unless($cartItem->cart->user_id === Auth::user()->user_id, 403);

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Cart updated.');
    }

    public function destroy(CartItem $cartItem)
    {
        abort_unless($cartItem->cart->user_id === Auth::user()->user_id, 403);

        $cartItem->delete();

        return back()->with('success', 'Product removed from cart.');
    }

    public function clear()
    {
        $this->currentCart()->cartItems()->delete();

        return back()->with('success', 'Cart cleared.');
    }
}
