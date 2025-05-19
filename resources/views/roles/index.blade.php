<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Roles List') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <a href="{{ route('role.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded hover:bg-blue-700">Create New Role</a>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Role Name</th>
                            <th class="px-4 py-3">Permissions</th>
                            <th class="px-4 py-3">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr class="border-b dark:border-gray-600">
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">{{ $role->name }}</td>
                                <td class="px-4 py-3">
                                    @foreach($role->permissions as $permission)
                                        <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                            {{ $permission->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('role.edit', $role->id) }}" class="text-blue-600 dark:text-orange-400 hover:underline mr-2">Edit</a>
                                    <form action="{{ route('role.destroy', $role->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:underline" onclick="return confirm('Are you want to delete this product?')">Delete</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
