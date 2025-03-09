<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Car Edit') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('admin.car.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 gap-6">

                            <div>
                                <x-text-input name="id" type="hidden" class="mt-1 block w-full"
                                    :value="old('id', $car->id)"  />
                            </div>

                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    :value="old('name', $car->name)" autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="brand" :value="__('Brand')" />
                                <x-text-input id="brand" name="brand" type="text" class="mt-1 block w-full"
                                    :value="old('brand', $car->brand)" autocomplete="brand" />
                                <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="model" :value="__('Model')" />
                                <x-text-input id="model" name="model" type="text" class="mt-1 block w-full"
                                    :value="old('model', $car->model)" autocomplete="model" />
                                <x-input-error :messages="$errors->get('model')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="year" :value="__('Year of Manufacture')" />
                                <x-text-input id="year" name="year" type="number" class="mt-1 block w-full"
                                    :value="old('year', $car->year)" autocomplete="year" />
                                <x-input-error :messages="$errors->get('year')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="car_type" :value="__('Car Type')" />
                                <x-text-input id="car_type" name="car_type" type="text" class="mt-1 block w-full"
                                    :value="old('car_type', $car->car_type)" autocomplete="car_type" />
                                <x-input-error :messages="$errors->get('car_type')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="daily_rent_price" :value="__('Daily Rent Price')" />
                                <x-text-input id="daily_rent_price" name="daily_rent_price" type="number" step="0.01"  min="0"
                                    class="mt-1 block w-full" :value="old('daily_rent_price', $car->daily_rent_price)" autocomplete="daily_rent_price" />
                                <x-input-error :messages="$errors->get('daily_rent_price')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="availability" :value="__('Availability')" />
                                <select name="availability" id="availability"
                                    class="form-select border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                    required>
                                    <option selected disabled>-- select an option --</option>
                                    <option value="1" {{ old('availability', $car->availability) == 1 ? 'selected' : '' }}>Available</option>
                                    <option value="0" {{ old('availability', $car->availability) == 0 ? 'selected' : '' }}>Not Available</option>
                                </select>
                                <x-input-error :messages="$errors->get('availability')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="image" :value="__('Image')" />
                                <img id="image_preview" src="{{ $car->image ? asset('storage/' . $car->image) : asset('images/images.png') }}" alt="Image Preview" class="mt-2 mb-2 object-cover" style="max-width: 200px; width: 200px; max-height: 200px; height: 200px;">
                                <input type="file" name="image" id="image"
                                    class="form-input border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                                    onchange="document.getElementById('image_preview').src = window.URL.createObjectURL(this.files[0])">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>

                        </div>
                        <div class="mt-6">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Save
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
