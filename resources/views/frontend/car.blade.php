@extends('index')

@section('content')
    <section id="car_details" class="py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 g-0 rounded">
                <div class="col-md-6">
                    <img src="{{ $car->image ? asset('/storage/' . $car->image) : asset('./images/car-01.jpg') }}" class="card-img-top img-fluid" alt="car image" style="height: 350px; object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm rounded-0">
                        <div class="card-body">
                            <h1 class="card-title">{{ $car->name }}</h1>
                            <ul class="list-unstyled">
                                <li><strong>Brand: </strong>{{ $car->brand }}</li>
                                <li><strong>Model: </strong>{{ $car->model }}</li>
                                <li><strong>Year: </strong>{{ $car->year }}</li>
                                <li><strong>Type: </strong>{{ $car->car_type }}</li>
                                <li><strong>Daily Rent: </strong> ৳<span>{{ $car->daily_rent_price }}</span></li>
                            </ul>
                            <form action="{{ route('admin.rental.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="car_id" value="{{ $car->id }}">
                                <input type="hidden" name="daily_rent_price" value="{{ $car->daily_rent_price }}">
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="status" value="pending">
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="start_date" class="form-label h6">Start Date:</label>
                                        <input type="date" name="start_date" class="form-control" id="start_date">
                                    </div>
                                    <div class="col">
                                        <label for="end_date" class="form-label h6">End Date:</label>
                                        <input type="date" name="end_date" class="form-control" id="end_date">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-dark w-100">Book Now</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
