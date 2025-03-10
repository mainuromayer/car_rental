<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Car;
use App\Models\User;
use App\Models\Rental;
use Illuminate\Http\Request;
use App\Mail\RentalConfirmMail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RentalController extends Controller
{
    public function create()
    {
        $users = User::all();
        $cars = Car::where('availability', '1')->get();
        return view('backend.admin.rental.create', compact('users', 'cars'));
    }


    public function store(Request $request)
    {
        try {
            $rental_id = $request->id;
            if ($rental_id) {
                $rental = Rental::with('user', 'car')->findOrFail($rental_id);
            } else {
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
    
            $existingRentalQuery = Rental::where('car_id', $request->input('car_id'))
                ->where(function ($query) use ($start_date, $end_date) {
                    $query->whereBetween('start_date', [$start_date, $end_date])
                          ->orWhereBetween('end_date', [$start_date, $end_date])
                          ->orWhere(function ($query) use ($start_date, $end_date) {
                              $query->where('start_date', '<=', $start_date)->where('end_date', '>=', $end_date);
                          });
                });
    
            if ($rental_id) {
                $existingRentalQuery->where('id', '!=', $rental_id);
            }
    
            $existingRental = $existingRentalQuery->exists();
    
            if ($existingRental) {
                if (Auth::user()->isAdmin()) {
                    return redirect()->route('rental.list')->with('status', 'error')->with('message', 'The car is already booked for the selected dates.');
                } elseif (Auth::user()->isCustomer()) {
                    return redirect()->route('customer.rental.list')->with('status', 'error')->with('message', 'The car is already booked for the selected dates.');
                }
            }
    
            $total_days = floatval(abs($end_date->diffInDays($start_date)));
            $car = Car::findOrFail($request->input('car_id'));
            $rental_cost = $car->daily_rent_price;
            $total_cost = $rental_cost * $total_days;
    
            $rentalData = [
                'user_id' => $request->input('user_id'),
                'car_id' => $request->input('car_id'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'total_cost' => $total_cost,
                'status' => $request->input('status'),
            ];
    
            $user = User::findOrFail($rentalData['user_id']);
            $car = Car::findOrFail($rentalData['car_id']);
            $user_email = $user->email;
            $user_name = $user->name;
            $car_name = $car->name;
            $car_brand = $car->brand;
    
            $rental->fill($rentalData);
            $rental->save();
    
            // Send email to the user
            Mail::to($user_email)->send(new RentalConfirmMail($rental, $user_name, $car_name, $car_brand, false));
    
            // Send email to the admin
            $adminEmail = 'mainuromayer@gmail.com'; // Change to your admin's email
            Mail::to($adminEmail)->send(new RentalConfirmMail($rental, $user_name, $car_name, $car_brand, true));
    
            $message = $rental->exists ? 'Rental updated successfully' : 'Rental created successfully';
    
            return redirect()->route(Auth::user()->isAdmin() ? 'rental.list' : 'customer.rental.list')
                             ->with('status', 'success')
                             ->with('message', $message);
        } catch (Exception $e) {
            return redirect()->route(Auth::user()->isAdmin() ? 'rental.list' : 'customer.rental.list')
                             ->with('status', 'error')
                             ->with('message', 'Operation failed: ' . $e->getMessage());
        }
    }
    
    


    public function list(Request $request)
    {
        try {
            $rentals = Rental::with('user', 'car')->orderBy('id', 'desc')->paginate(5);

            return view('backend.admin.rental.list', compact('rentals'));
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function details($id)
    {
        $rental = Rental::with('user', 'car')->find($id);
        return view('backend.admin.rental.details', compact('rental'));
    }

    public function delete($id)
    {
        try {
            $rental = Rental::find($id);
            $rental->delete();
            return redirect()->route('rental.list')->with('status', 'success')->with('message', 'Rental deleted successfully!');

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'error' => $e->getMessage()
            ], 400);
        }

    }

    public function edit($id)
    {
        $rental = Rental::with('user', 'car')->findOrFail($id);
        $users = User::all();
        $cars = Car::all();
        return view('backend.admin.rental.edit', compact('rental', 'users', 'cars'));
    }



    public function customerRentallist(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            $rentals = Rental::with('user', 'car')
                ->where('user_id', $user_id)
                ->where('status', 'pending')
                ->orderBy('id', 'desc')
                ->paginate(5);

            return view('backend.customer.rental.list', compact('rentals'));
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function customerRentalHistorylist(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            $rentals = Rental::with('user', 'car')
                ->where('user_id', $user_id)
                ->whereNot('status', 'pending')
                ->orderBy('id', 'desc')
                ->paginate(5);

            return view('backend.customer.rental_history.list', compact('rentals'));
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    // public function customerRentedStore(Request $request) {
    //     try {
    //         $rental_id = $request->id;
    //         if($rental_id){
    //             $rental = Rental::findOrFail($rental_id);
    //         } else{
    //             $rental = new Rental();
    //         }
    //         $request->validate([
    //             'user_id' => 'required|exists:users,id',
    //             'car_id' => 'required|exists:cars,id',
    //             'start_date' => 'required|date',
    //             'end_date' => 'required|date|after_or_equal:start_date',
    //         ]);

    //         $start_date = Carbon::parse($request->input('start_date'));
    //         $end_date = Carbon::parse($request->input('end_date'));

    //         $existingRental = Rental::where('car_id', $request->input('car_id'))
    //         ->where(function ($query) use ($start_date, $end_date){
    //             $query->whereBetween('start_date',[$start_date, $end_date])
    //             ->orWhereBetween('end_date',[$start_date, $end_date])
    //             ->orWhere(function ($query) use ($start_date, $end_date){
    //                 $query->where('start_date', '<=', $start_date)->where('end_date', '>=', $end_date);
    //             });
    //         })->exists();
    //         // dd($existingRental);

    //         if($existingRental){
    //             return redirect()->route('customer.rental.list')->with('status', 'error')->with('message', 'The car is already booked for the selected dates.');
    //         }


    //         $total_days = floatval(abs($end_date->diffInDays($start_date)));
    //         $car = Car::findOrFail($request->input('car_id'));
    //         $rental_cost = $car->daily_rent_price;


    //         $total_cost =  $rental_cost * $total_days;

    //         $rentalData = [
    //             'user_id' => $request->input('user_id'),
    //             'car_id' => $request->input('car_id'),
    //             'start_date' => $request->input('start_date'),
    //             'end_date' => $request->input('end_date'),
    //             'total_cost' => $total_cost,
    //             'status' => 'pending',
    //         ];



    //     if ($rental->exists) {
    //         $rental->update($rentalData);
    //         $message = 'Rental updated successfully';
    //     } else {
    //         $rental->create($rentalData);
    //         $message = 'Rental created successfully';
    //     }

    //         return redirect()->route('customer.rental.list')->with('status', 'success')->with('message', $message);
    //     } catch (Exception $e) {
    //         return redirect()->route('customer.rental.list')->with('status', 'error')->with('message', 'Operation failed: ' . $e->getMessage());
    //     }
    // }



    public function customerRentalDelete($id)
    {
        try {
            $rental = Rental::find($id);
            $rental->delete();
            return redirect()->route('customer.rental.list')->with('status', 'success')->with('message', 'Rental cancelled successfully!');

        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'error' => $e->getMessage()
            ], 400);
        }

    }





}
