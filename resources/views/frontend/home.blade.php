@extends('index')

@section('content')
    <section id="hero" class="py-5 bg-dark">
        <div class="container">
            <h1 class="text-white">Rent The Best Car With <span class="text-warning">Affordable Prices</span></h1>
            <p class="text-white">Explore a wide range of cars for your trips. From luxury to economy have the perfect
                vehicle for every occasion.</p>
        </div>
    </section>
    <section id="car_features" class="py-5 bg-light">
        <div class="container">
            <h1 class="text-center mb-4">Featured Cars</h1>
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
