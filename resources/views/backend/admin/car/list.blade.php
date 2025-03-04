<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(key: 'Car List') }}
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
                        <form method="GET" action="{{ route('admin.car.list') }}">
                            <div class="flex items-center">
                                <input type="text" name="search" placeholder="Search cars..."
                                    class="form-input rounded-md shadow-sm mt-1 block w-full"
                                    value="{{ request('search') }}">
                                <button type="submit"
                                    class="ml-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Search
                                </button>
                            </div>
                        </form>
                        <a href="{{ route('admin.car.create') }}"
                            class="ml-3 inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Add Car
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
                                    Brand
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Model
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Year
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Car Type
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Daily Rent Price
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Availablity
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Image
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($cars as $car)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $car->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $car->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $car->brand }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $car->model }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $car->year }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $car->car_type }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $car->daily_rent_price }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $car->availability === 1 ? 'Available' : 'Not Available' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if ($car->image)
                                            <img src="{{ Storage::url($car->image) }}" alt="Car Image" style="width:40px; height:40px; object-fit:cover;">
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                                        <a href="{{ route('admin.car.details', $car->id) }}"
                                            class="text-indigo-600 hover:text-green-900 transition duration-200 ease-in-out transform hover:scale-110">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.car.edit', $car->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 transition duration-200 ease-in-out transform hover:scale-110 ml-4">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.car.delete', $car->id) }}" method="POST" class="inline-block ml-4">
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
                        {{ $cars->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
