<?php

namespace App\Services;

namespace App\Helpers;

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\EnumGetHelper;

class ProductController extends \Illuminate\Routing\Controller
{
    public function __construct(protected ProductService $productService)
    {
        $this->productService = $productService;

        $this->middleware(['permission:product-list'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:product-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:product-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:product-delete'], ['only' => ['delete']]);


    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartProductIds = [];
        if ($cart) {
            $cartProductIds = $cart->products()->pluck('product_id')->toArray(); // get product IDs in the cart
        }
        return view('product.index', compact('products', 'cartProductIds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories =  EnumGetHelper::getEnumValues('products', 'category');
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputField = $request->validate([
            'product_name' => 'required|max:25',
            'description' => 'required',
            'category' => 'required',
            'quantity' => 'required|'
        ]);

        if ($inputField) {
            Product::create($inputField);
        }

        return redirect()->route('product.index')->with('success', 'New product successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Product::select('category')->distinct()->pluck('category')->toArray();
        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inputField = $request->validate([
           'product_name' => 'required|max:25',
           'description' => 'required',
           'category' => 'required',
           'quantity' => 'required|'
        ]);

        $product = Product::find($id);
        if (!$product) {
            return redirect('product.index')->with('error', 'User not Found!');
        }
        $product->product_name = $inputField['product_name'];
        $product->description = $inputField['description'];
        $product->category = $inputField['category'];
        $product->quantity = $inputField['quantity'];

        $product->save();

        return redirect()->route('product.index')->with('success', 'Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::find($id)->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully');

    }

    public function addToCart(string $id)
    {
        $this->productService->addToCart($id);
        return redirect()->back()->with('success', 'Product added to cart');
    }
}
