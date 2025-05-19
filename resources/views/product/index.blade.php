<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                @can('product-create')
                <a href="{{ route('product.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded hover:bg-blue-700">Create Product</a>
                @endcan
                <div class="overflow-x-auto">
                    <table class="min-w-full ta ble-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700 text-left">
                                <th class="px-4 py-2 text-gray-700 dark:text-gray-200">#</th>
                                <th class="px-4 py-2 text-gray-700 dark:text-gray-200">Name</th>
                                <th class="px-4 py-2 text-gray-700 dark:text-gray-200">Description</th>
                                <th class="px-4 py-2 text-gray-700 dark:text-gray-200">Category</th>
                                <th class="px-4 py-2 text-gray-700 dark:text-gray-200">Quantity</th>
                                <th class="px-4 py-2 text-gray-700 dark:text-gray-200">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="border-b dark:border-gray-600">
                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-300">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-300">{{ $product->product_name }}</td>
                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-300">{{ $product->description }}</td>
                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-300">{{ ucfirst($product->category) }}</td>
                                    <td class="px-4 py-2 text-gray-800 dark:text-gray-300">{{ $product->quantity }}</td>
                                    <td class="px-4 py-2">
                                        @can('product-list')
                                        <a href="{{ route('product.show', $product->id) }}"
                                            class="text-blue-600 dark:text-green-400 hover:underline mr-2">Show</a>
                                        @endcan
                                        @can('product-edit')
                                        <a href="{{ route('product.edit', $product->id) }}" class="text-blue-600 dark:text-orange-400 hover:underline mr-2">Edit</a>
                                        @endcan
                                        @can('product-delete')
                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 hover:underline" onclick="return confirm('Are you want to delete this product?')">Delete</button>
                                        </form>
                                        @endcan
                                        @if (in_array($product->id, $cartProductIds))
                                            <a href="{{ route('cart.index') }}" class="text-green-600 hover:underline ml-2">Go to Cart</a>
                                        @else
                                            <form action="{{ route('addtocart', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:underline ml-2">Add to cart</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>  
</x-app-layout>