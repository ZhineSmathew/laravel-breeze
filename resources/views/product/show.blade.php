<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Management') }}
        </h2>
    </x-slot>

     <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-700 dark:text-gray-100">
                {{ $product->name }}
            </h3>

            <table class="min-w-full border border-gray-300 dark:border-gray-600">
                <tbody class="text-gray-800 dark:text-gray-300">
                    <tr class="border-b">
                        <th class="px-4 py-2 text-left bg-gray-100 dark:bg-gray-700">Name</th>
                        <td class="px-4 py-2">{{ $product->product_name }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="px-4 py-2 text-left bg-gray-100 dark:bg-gray-700">Price</th>
                        <td class="px-4 py-2">{{ $product->description }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="px-4 py-2 text-left bg-gray-100 dark:bg-gray-700">Category</th>
                        <td class="px-4 py-2">{{ $product->category }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="px-4 py-2 text-left bg-gray-100 dark:bg-gray-700">Quantity</th>
                        <td class="px-4 py-2">{{ $product->quantity }}</td>
                    </tr>
                    <!-- Add more fields if necessary -->
                </tbody>
            </table>

            <div class="mt-6">
                <a href="{{ route('product.index') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded hover:bg-blue-700">Back</a>
            </div>
        </div>
    </div>





</x-app-layout>