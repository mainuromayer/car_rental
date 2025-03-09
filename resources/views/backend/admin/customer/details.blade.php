<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Details') }}
        </h2>
    </x-slot>


    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">

                    <div class="mb-4">
                        <h1 class="text-2xl font-bold text-gray-800">{{ $customer->name }}</h1>
                        <p class="text-gray-600"><strong>Email:</strong> {{ $customer->email }}</p>
                        <p class="text-gray-600"><strong>Phone:</strong> {{ $customer->phone }}</p>
                        <p class="text-gray-600"><strong>Address:</strong> {{ $customer->address }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <table class="min-w-full divide-y divide-gray-200 mt-6">
        <thead>
            <tr>

                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Car Name
                </th>
                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Start Date
                </th>
                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    End Date
                </th>
                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Total Cost
                </th>
                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($rentals as $rental)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $rental->car->name }}
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $rental->start_date }}
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $rental->end_date }}
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $rental->total_cost }}
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span>{{ $rental->status }}</span>
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                        <a href="{{ route('rental.edit', $rental->id) }}"
                            class="text-indigo-600 hover:text-indigo-900 transition duration-200 ease-in-out transform hover:scale-110 ml-4">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('rental.delete', $rental->id) }}" method="POST" class="inline-block ml-4">
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
    {{-- <div class="mt-4">
        {{ $rentals->links() }}
    </div> --}}

</x-app-layout>
