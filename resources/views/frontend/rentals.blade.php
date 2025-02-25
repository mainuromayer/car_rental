@extends('index')

@section('content')
    <section id="car_features" class="py-5 bg-light">
        <div class="container">
            <h1 class="text-center mb-4">Available Cars</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">
                <div class="col">
                  <select name="" id="" class="form-control">
                    <option value="" disabled selected>All Car</option>
                    <option value="">Option 2</option>
                    <option value="">Option 3</option>
                  </select>
                </div>
                <div class="col">
                  <select name="" id="" class="form-control">
                    <option value="" disabled selected>All Brand</option>
                    <option value="">Option 2</option>
                    <option value="">Option 3</option>
                  </select>
                </div>
                <div class="col">
                  <input type="search" class="form-control" placeholder="Max Daily Rent Price" name="" id="">
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('./images/car-01.jpg') }}" class="card-img-top img-fluid h-100" alt="car 01">
                        <div class="card-body">
                            <h5 class="card-title">Car Name</h5>
                            <p class="card-text">
                                <span>
                                    Brand: Bogan
                                </span> |
                                <span>
                                    Type: Gasoline
                                </span> |
                                <span>
                                    Year: 2022
                                </span>
                            </p>
                            <p>Daily Rent: $<span>224.43</span></p>
                            <a href="{{ route('car_details', ['id' => 1]) }}" class="btn btn-dark">Rent Now</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('./images/car-02.jpg') }}" class="card-img-top img-fluid h-100" alt="car 02">
                        <div class="card-body">
                            <h5 class="card-title">Car Name</h5>
                            <p class="card-text">
                                <span>
                                    Brand: Bogan
                                </span> |
                                <span>
                                    Type: Gasoline
                                </span> |
                                <span>
                                    Year: 2022
                                </span>
                            </p>
                            <p>Daily Rent: $<span>224.43</span></p>
                            <a href="{{ route('car_details', ['id' => 2]) }}" class="btn btn-dark">Rent Now</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('./images/car-03.jpg') }}" class="card-img-top img-fluid h-100" alt="car 03">
                        <div class="card-body">
                            <h5 class="card-title">Car Name</h5>
                            <p class="card-text">
                                <span>
                                    Brand: Bogan
                                </span> |
                                <span>
                                    Type: Gasoline
                                </span> |
                                <span>
                                    Year: 2022
                                </span>
                            </p>
                            <p>Daily Rent: $<span>224.43</span></p>
                            <a href="{{ route('car_details', ['id' => 3]) }}" class="btn btn-dark">Rent Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
