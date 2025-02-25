@extends('index')

@section('content')

<section id="contact_us" class="py-5 bg-light">
    <div class="container">
        <h1 class="text-center mb-4">Contact Us</h1>
        <p class="text-center mb-5">If you have any questions or need further information, please feel free to contact us. We are here to help you.</p>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm p-4">
                    <h3>Our Address</h3>
                    <p>123 Car Rental Street, City, Country</p>
                    <h3>Phone</h3>
                    <p>+123 456 7890</p>
                    <h3>Email</h3>
                    <p>info@carrental.com</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm p-4">
                    <h3>Contact Form</h3>
                    <form>
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group mb-4">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" rows="4" placeholder="Enter your message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
