@extends('index')

@section('content')
<section id="hero" class="py-5 bg-dark">
  <div class="container">
    <h1 class="text-white">Rent The Best Car With <span class="text-warning">Affordable Prices</span></h1>
    <p class="text-white">Explore a wide range of cars for your trips. From luxury to economy have the perfect vehicle for every occasion.</p>
  </div>
</section>
<section id="car_features" class="py-5 bg-light">
    <div class="container">
        <h1 class="text-center mb-4">Featured Cars</h1>
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
                  <a href="#" class="btn btn-dark">Rent Now</a>
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
                  <a href="#" class="btn btn-dark">Rent Now</a>
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
                    <a href="#" class="btn btn-dark">Rent Now</a>
                  </div>
                </div>
              </div>
          </div>
    </div>
</section>
@endsection