@extends('index')

@section('content')
    <section id="car_features" class="py-5 bg-light">
        <div class="container">
            <h1 class="text-center mb-4">Available Cars</h1>
            <form action="{{ route('rentals') }}" method="get" class="mb-4">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <div class="col">
                        <label for="model" class="fw-bold mb-2">Model: </label>
                        <select name="model" id="model" class="form-select">
                            <option value="">All Car</option>
                            @foreach ($models as $model)
                                <option value="{{ $model }}" {{ request('model') == $model ? 'selected' : '' }}>{{ $model }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="brand" class="fw-bold mb-2">Brand: </label>
                        <select name="brand" id="brand" class="form-select">
                            <option value="">All Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="max_rent_price" class="fw-bold mb-2">Max Daily Rent Price: </label>
                        <input type="number" class="form-control" placeholder="Max Daily Rent Price" name="max_rent_price" id="max_rent_price" value="{{ request('max_rent_price') }}">
                    </div>
                    <div class="col d-flex align-items-end">
                        <button type="submit" class="btn btn-dark w-100">Filter</button>
                    </div>
                </div>
            </form>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($cars as $car)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ $car->image ? asset('/storage/' . $car->image) : asset('./images/car-01.jpg') }}" class="card-img-top img-fluid" alt="car image" style="height: 300px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $car->name }}</h5>
                                <p class="card-text">
                                    <span>
                                        Brand: {{ $car->brand }}
                                    </span> |
                                    <span>
                                        Model: {{ $car->model }}
                                    </span> |
                                    <span>
                                        Type: {{ $car->car_type }}
                                    </span> |
                                    <span>
                                        Year: {{ $car->year }}
                                    </span>
                                </p>
                                <p>Daily Rent: $<span>{{ $car->daily_rent_price }}</span></p>
                                <a href="{{ route('car_details', ['id' => $car->id]) }}" class="btn btn-dark">Rent Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
