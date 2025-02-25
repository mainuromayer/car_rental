@extends('index')

@section('content')
<section id="about_us" class="py-5 bg-light">
    <div class="container">
        <h1 class="text-center mb-4">About Us</h1>
        <p class="text-center">We are a leading car rental service provider, committed to offering the best vehicles at the most competitive prices. Our fleet includes a wide range of cars to suit every need, from luxury sedans to economy hatchbacks. Our mission is to make car rental easy, affordable, and accessible for everyone.</p>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('./images/car-01.jpg') }}" class="card-img-top img-fluid h-100" alt="car 01">
            </div>
            <div class="col-md-6">
                <h3>Our Mission</h3>
                <p>To provide high-quality car rental services that meet the diverse needs of our customers. We strive to offer a seamless rental experience with a focus on customer satisfaction and value for money.</p>
                <h3>Our Vision</h3>
                <p>To be the preferred car rental service provider, known for our reliability, affordability, and exceptional customer service. We aim to continuously improve and expand our services to meet the evolving needs of our customers.</p>
            </div>
        </div>
    </div>
</section>
@endsection
