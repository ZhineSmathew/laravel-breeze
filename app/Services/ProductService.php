<?php

namespace App\services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $existingProduct = $cart->products()->where('product_id', $id)->first();

        if (!$existingProduct) 
        {
            $cart->products()->attach($product->id, ['quantity' => 1]);
            
            // Decrease product stock by 1
            $product->decrement('quantity', 1);
        }

        return true;
                
    }

    public function addMoreQuantiy($id) 
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->firstOrFail();


        // Check if the product is in the cart
        $existingProduct = $cart->products()->where('product_id', $product->id)->first();

        if ($existingProduct) {
            // Increase the quantity for this specific product in pivot
            $cart->products()->updateExistingPivot($product->id, [
                'quantity' => $existingProduct->pivot->quantity + 1
            ]);

            // Optional: Decrease stock in product table
            $product->decrement('quantity', 1);
        }
        return true;
    }

    public function reduseQuantity($id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->firstOrFail();
        $existingProduct = $cart->products()->where('product_id', $product->id)->first();
        if ($existingProduct) {
            $currentQty = $existingProduct->pivot->quantity; // get current quantity
                if ($currentQty > 1) { 
                // Reduce quantity by 1
                $cart->products()->updateExistingPivot($product->id, [
                    'quantity' => $currentQty - 1
                ]);
                } else {
                    // If quantity is 1, remove the product from the cart
                    $cart->products()->detach($product->id);
                }

                // Increase product stock
                $product->increment('quantity', 1);

        }
        return true;
    }

}
