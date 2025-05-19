<?php

namespace App\Services;
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->firstOrFail();
        $cartDetails = $cart->products;
        return view('cart.index',compact('cartDetails'));   
    }
    /**
     * Add more quantity to the cart
     */
    public function addMoreQuantiy($id)
    {
        $this->productService->addMoreQuantiy($id);
        return redirect()->back()->with('success');

    }
    /**
     * Reduse the quantity from the cart
     */
    public function removeQuantity($id)
    {
        $this->productService->reduseQuantity($id);
        return redirect()->back()->with('success');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
