<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Roles') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('role.update', $role->id) }}">
                    @csrf
                    @method('PUT')
                    {{-- Role Name --}}
                    <div class="mb-4">
                        <label for="name" class="block font-medium text-gray-700 dark:text-gray-300">Role Name</label>
                        <input type="text" name="name" id="name" value="{{ $role->name }}"
                            class="w-full mt-1 px-4 py-2 border rounded-md dark:bg-gray-700 dark:text-white dark:border-gray-600 focus:ring focus:ring-blue-400">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Permissions --}}
                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 dark:text-gray-300 mb-2">Permissions</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                            @foreach ($permissions as $permission)
                                <label class="flex items-center space-x-2 text-sm dark:text-gray-200">
                                    <input type="checkbox" name="permission[{{ $permission->name }}]" value="{{ $permission->name }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                        class="rounded text-blue-600 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                                    <span>{{ ucfirst($permission->name) }}</span>
                                </label>
                            @endforeach
                        </div>

                    </div>

                    <div class="mt-6">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Update
                        </button>
                        <a href="{{ route('role.index') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded hover:bg-blue-700">Back</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
