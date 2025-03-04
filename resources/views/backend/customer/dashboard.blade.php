<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Dashboard Stats -->
            <div class="grid lg:grid-cols-4 sm:grid-cols-2 gap-4">
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gray-200 p-3 rounded">
                            <i class="fas fa-car text-4xl"></i>
                        </div>
                        <div>
                            <p>Total Cars</p>
                            <p class="font-bold text-lg">{{ $total_cars }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gray-200 p-3 rounded">
                            <i class="fas fa-check-circle text-4xl"></i>
                        </div>
                        <div>
                            <p>Available Cars</p>
                            <p class="font-bold text-lg">{{ $available_cars }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="bg-gray-200 p-3 rounded">
                            <i class="fas fa-exchange-alt text-4xl"></i>
                        </div>
                        <div>
                            <p>Total Rentals</p>
                            <p class="font-bold text-lg">{{ $total_rentals }}</p>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</x-app-layout>
