<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rental Details') }}
        </h2>
    </x-slot>


    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">

                    <div class="mb-4">
                        <h1 class="text-2xl font-bold text-gray-800">{{ $rental->car->name }}</h1>
                        <p class="text-gray-600"><strong>Car Brand:</strong> {{ $rental->car->brand }}</p>
                        <p class="text-gray-600"><strong>Start Date:</strong> {{ $rental->start_date }}</p>
                        <p class="text-gray-600"><strong>End Date:</strong> {{ $rental->end_date }}</p>
                        <p class="text-gray-600"><strong>Customer Name:</strong> {{ $rental->user->name }}</p>
                        <p class="text-gray-600"><strong>Total Cost:</strong> ৳{{ $rental->total_cost }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
