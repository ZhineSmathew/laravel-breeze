<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('product.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="product_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Name</label>
                        <input type="text" name="product_name" id="product_name" value="{{ old('product_name') }}" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea name="description" id="description" rows="3" value="{{ old('description') }}" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500"></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />

                    </div>

                    <div class="mb-4">
                        <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                        <input type="text" name="category" id="category" value="{{ old('category') }}" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="quantity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quantity</label>
                        <input type="number" name="quantity" id="quantity" min="0" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Save Product
                        </button>
                        <a href="{{ route('product.index') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded hover:bg-blue-700">Back</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>