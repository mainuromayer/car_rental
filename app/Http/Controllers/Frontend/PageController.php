<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function homePage () {
        return view('frontend.home');
    }
    public function aboutPage () {
        return view('frontend.about');
    }
    public function rentalPage () {
        return view('frontend.rentals');
    }

    public function carDetailsPage ($id) {
        return view('frontend.car', ['id' => $id]);
    }

    public function contactPage () {
        return view('frontend.contact');
    }


    public function dashboard(){
        return view('backend.dashboard');
    }
    public function customerIndex(){
        return view('backend.customer.index');
    }
    public function customerForm(){
        return view('backend.customer.form');
    }
    public function rentalIndex(){
        return view('backend.rental.index');
    }
    public function rentalForm(){
        return view('backend.rental.form');
    }

}
