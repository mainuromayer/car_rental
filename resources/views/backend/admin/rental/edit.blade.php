<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rental Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('admin.rental.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 gap-6">

                            <div>
                                <x-text-input name="id" type="hidden" class="mt-1 block w-full"
                                    :value="old('id', $rental->id)" />
                            </div>

                            <div>
                                <x-input-label for="customer" :value="__('Customer')" />
                                <select name="user_id" id="customer" class="form-select border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option selected disabled>-- select an option --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id', $rental->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="car" :value="__('Car')" />
                                <select name="car_id" id="car" class="form-select border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option selected disabled>-- select an option --</option>
                                    @foreach($cars as $car)
                                        <option value="{{ $car->id }}" {{ old('car_id', $rental->car_id) == $car->id ? 'selected' : '' }}>{{ $car->name }} - {{ $car->brand }} ({{ $car->year }})</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('car_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="start_date" :value="__('Start Date')" />
                                <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="old('start_date', $rental->start_date)" autocomplete="start_date" />
                                <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="end_date" :value="__('End Date')" />
                                <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" :value="old('end_date', $rental->end_date)" autocomplete="end_date" />
                                <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <select name="status" id="status" class="form-select border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option selected disabled>-- select an option --</option>
                                    <option value="pending" {{ old('status', $rental->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="ongoing" {{ old('status', $rental->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="completed" {{ old('status', $rental->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="canceled" {{ old('status', $rental->status) == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>


                        </div>
                        <div class="mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Save
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
