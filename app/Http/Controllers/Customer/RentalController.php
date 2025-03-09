<?php

namespace App\Http\Controllers\Customer;

use Exception;
use Carbon\Carbon;
use App\Models\Car;
use App\Models\User;
use App\Models\Rental;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RentalController extends Controller
{
    public function create()
    {
        $users = User::all();
        $cars = Car::where('availability', '1')->get();
        return view('backend.rental.create', compact('users', 'cars'));
    }


    public function store(Request $request){

        try {
            $rental_id = $request->id;
            if($rental_id){
                $rental = Rental::findOrFail($rental_id);
            } else{
                $rental = new Rental();
            }
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'car_id' => 'required|exists:cars,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'status' => 'required|string|in:pending,ongoing,completed,canceled',
            ]);

            $start_date = Carbon::parse($request->input('start_date'));
            $end_date = Carbon::parse($request->input('end_date'));

            $existingRental = Rental::where('car_id', $request->input('car_id'))
            ->where(function ($query) use ($start_date, $end_date){
                $query->whereBetween('start_date',[$start_date, $end_date])
                ->orWhereBetween('end_date',[$start_date, $end_date])
                ->orWhere(function ($query) use ($start_date, $end_date){
                    $query->where('start_date', '<=', $start_date)->where('end_date', '>=', $end_date);
                });
            })->exists();
            // dd($existingRental);

            if($existingRental){
                return redirect()->route('rental.list')->with('status', 'error')->with('message', 'The car is already booked for the selected dates.');
            }


            $total_days = floatval(abs($end_date->diffInDays($start_date)));
            $car = Car::findOrFail($request->input('car_id'));
            $rental_cost = $car->daily_rent_price;


            $total_cost =  $rental_cost * $total_days;

            $rentalData = [
                'user_id' => $request->input('user_id'),
                'car_id' => $request->input('car_id'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'total_cost' => $total_cost,
                'status' => $request->input('status'),
            ];

            

        if ($rental->exists) {
            $rental->update($rentalData);
            $message = 'Rental updated successfully';
        } else {
            $rental->create($rentalData);
            $message = 'Rental created successfully';
        }
    
            return redirect()->route('rental.list')->with('status', 'success')->with('message', $message);
        } catch (Exception $e) {
            return redirect()->route('rental.list')->with('status', 'error')->with('message', 'Operation failed: ' . $e->getMessage());
        }
    }
    

    public function list(Request $request){
        try{
            $rentals = Rental::with('user', 'car')->orderBy('id', 'desc')->paginate(5);
            
            return view('backend.rental.list', compact('rentals'));
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function details($id){
        $rental = Rental::with('user','car')->find($id);
        return view('backend.rental.details', compact('rental'));
    }

    public function delete($id){
        try{
            $rental = Rental::find($id);
            $rental->delete();
            return redirect()->route('rental.list')->with('status', 'success')->with('message', 'Rental deleted successfully!');
            
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'error' => $e->getMessage()
            ], 400);
        }

    }

    public function edit($id){
        $rental = Rental::with('user','car')->findOrFail($id);
        $users = User::all();
        $cars = Car::all();
        return view('backend.rental.edit', compact('rental', 'users', 'cars'));
    }
}
