<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cart Items') }}
        </h2>
    </x-slot>
    @foreach ($cartDetails as $product)
    <div class="py-4">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        <a href="{{ route('product.show', $product->id) }}" class="hover:underline text-blue-600 dark:text-blue-400">
                            {{ $product->product_name }}
                        </a>
                    </h3>
                </div>

                <form action="{{ route('cart.decrease', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-white bg-green-500 hover:bg-green-600 px-2 rounded">-</button>
                </form>

                <div class="flex items-center space-x-3">
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-300">Quantity:</span>
                    <span class="px-3 py-1 bg-blue-600 text-white rounded-full">
                        {{ $product->pivot->quantity }} 
                    </span>
                </div>
                <form action="{{ route('cart.increase', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-white bg-green-500 hover:bg-green-600 px-2 rounded">+</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    @if ($cartDetails->isEmpty())
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("No Data Avilable") }}
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
