<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function homePage () {
        $cars = Car::with('rentals')->where('availability', '1')->get();
        return view('frontend.home', compact('cars'));
    }
    public function aboutPage () {
        return view('frontend.about');
    }
    public function rentalPage (Request $request) {
        $brand = $request->query('brand');
        $model = $request->query('model');
        $max_rent_price = $request->query('max_rent_price');

        $cars = Car::with('rentals')->where('availability', '1');

        if($brand){
            $cars->where('brand', $brand);
        }

        if($model){
            $cars->where('model', $model);
        }

        if($max_rent_price){
            $cars->where('daily_rent_price','<=', $max_rent_price);
        }

        $cars = $cars->get();
        $brands = Car::distinct()->pluck('brand');
        $models = Car::distinct()->pluck('model');

        return view('frontend.rentals', compact('cars', 'brands', 'models'));
    }

    public function carDetailsPage ($id) {
        $car = Car::with('rentals')->findOrFail($id);
        return view('frontend.car', ['id' => $id], compact('car'));
    }

    public function contactPage () {
        return view('frontend.contact');
    }


    public function adminDashboard(){
        $total_cars = Car::all()->count();
        $available_cars = Car::with('rentals')->where('availability', '1')->get()->count();
        $total_rentals = Rental::where('status', 'completed')->count();
        $total_earnings = Rental::where('status', 'completed')->sum('total_cost');
        return view('backend.admin.dashboard', compact('total_cars', 'available_cars', 'total_rentals', 'total_earnings'));
    }

    public function customerDashboard(){
        $total_cars = Car::all()->count();
        $available_cars = Car::with('rentals')->where('availability', '1')->get()->count();
        $total_rentals = Rental::where('status', 'completed')->count();
        return view('backend.customer.dashboard', compact('total_cars', 'available_cars', 'total_rentals'));
    }
    


}
