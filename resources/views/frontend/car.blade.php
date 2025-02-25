@extends('index')

@section('content')
    <section id="car_details" class="py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 g-0 rounded">
                <div class="col-md-6">
                    <img src="{{ asset('./images/car-01.jpg') }}" class="img-fluid" alt="car 01">
                </div>
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm rounded-0">
                        <div class="card-body">
                            <h1 class="card-title">Car Name</h1>
                            <ul class="list-unstyled">
                                <li><strong>Brand:</strong> Bogan</li>
                                <li><strong>Model:</strong> Sedan</li>
                                <li><strong>Year:</strong> 2002</li>
                                <li><strong>Type:</strong> Hybrid</li>
                                <li><strong>Daily Rent:</strong> ৳<span>224.43</span></li>
                            </ul>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="start_date" class="form-label h6">Start Date:</label>
                                    <input type="date" class="form-control" id="start_date">
                                </div>
                                <div class="col">
                                    <label for="end_date" class="form-label h6">End Date:</label>
                                    <input type="date" class="form-control" id="end_date">
                                </div>
                            </div>
                            <a href="#" class="btn btn-dark w-100">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
