<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Car Details') }}
        </h2>
    </x-slot>


    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">

                    <div class="mb-4">
                        <h1 class="text-2xl font-bold text-gray-800">{{ $car->name }}</h1>
                        <p class="text-gray-600"><strong>Car Brand:</strong> {{ $car->brand }}</p>
                        <p class="text-gray-600"><strong>Car Model:</strong> {{ $car->model }}</p>
                        <p class="text-gray-600"><strong>Car Year:</strong> {{ $car->year }}</p>
                        <p class="text-gray-600"><strong>Car Type:</strong> {{ $car->car_type }}</p>
                        <p class="text-gray-600"><strong>Daily Rent Price:</strong> ৳{{ $car->daily_rent_price }}</p>
                        <p class="text-gray-600"><strong>Availablity:</strong> {{ $car->availability === 1 ? 'Available' : 'Not Available' }}</p>
                        <p class="text-gray-600"><strong>Image:</strong>
                            <img id="image_preview" src="{{ $car->image ? asset('storage/' . $car->image) : asset('images/images.png') }}" alt="Image Preview" class="mt-2 mb-2 object-cover" style="max-width: 200px; width: 200px; max-height: 200px; height: 200px;">
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
