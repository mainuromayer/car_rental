<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(key: 'Customer List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="my-2">
                        @if (session('status') === 'success')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ session('message') }}
                            </p>
                        @elseif (session('status') === 'error')
                            <p class="mt-2 font-medium text-sm text-red-600">
                                {{ session('message') }}
                            </p>
                        @endif
                    </div>

                    <div class="flex justify-between items-center mb-4">
                        <form method="GET" action="{{ route('admin.customer.list') }}">
                            <div class="flex items-center">
                                <input type="text" name="search" placeholder="Search customers..."
                                    class="form-input rounded-md shadow-sm mt-1 block w-full"
                                    value="{{ request('search') }}">
                                <button type="submit"
                                    class="ml-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Search
                                </button>
                            </div>
                        </form>
                        <a href="{{ route('admin.customer.create') }}"
                            class="ml-3 inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Add Customer
                        </a>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200 mt-6">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    #
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Phone
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Address
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($customers as $customer)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $customer->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $customer->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $customer->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $customer->phone }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $customer->address }}
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                                        <a href="{{ route('admin.customer.details', $customer->id) }}"
                                            class="text-indigo-600 hover:text-green-900 transition duration-200 ease-in-out transform hover:scale-110">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.customer.edit', $customer->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 transition duration-200 ease-in-out transform hover:scale-110 ml-4">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.customer.delete', $customer->id) }}" method="POST" class="inline-block ml-4">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 transition duration-200 ease-in-out transform hover:scale-110">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
