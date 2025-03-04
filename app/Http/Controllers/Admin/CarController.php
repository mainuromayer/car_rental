<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class CarController extends Controller
{

    public function create(){
        return view('backend.admin.car.create');
    }


    public function store(Request $request){
        try {
            $car_id = $request->id;
            if($car_id){
                $car = Car::findOrFail($car_id);
                $imagePath = $car->image;
            } else{
                $car = new Car();
                $imagePath = null;
            }
            $request->validate([
                'name' => 'required|string',
                'brand' => 'required|string',
                'model' => 'required|string',
                'year' => 'required|integer',
                'car_type' => 'required|string',
                'daily_rent_price' => 'required|numeric',
                'availability' => 'required|boolean',
                'image' => 'nullable|image'
            ]);
    
            $availability = (bool) $request->input('availability');

            
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
            }

            $carData = [
                'name' => $request->input('name'),
                'brand' => $request->input('brand'),
                'model' => $request->input('model'),
                'year' => $request->input('year'),
                'car_type' => $request->input('car_type'),
                'daily_rent_price' => $request->input('daily_rent_price'),
                'availability' => $availability,
                'image' => $imagePath
            ];

        if ($car->exists) {
            $car->update($carData);
            $message = 'Car updated successfully';
        } else {
            $car->create($carData);
            $message = 'Car created successfully';
        }
    
            return redirect()->route('admin.car.list')->with('status', 'success')->with('message', $message);
        } catch (Exception $e) {
            return redirect()->route('admin.car.list')->with('status', 'error')->with('message', 'Operation failed: ' . $e->getMessage());
        }
    }
    

    public function list(Request $request){
        try{
            $cars = Car::orderBy('id', 'desc')->paginate(5);
            return view('backend.admin.car.list', compact('cars'));
        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function details($id){
        $car = Car::find($id);
        return view('backend.admin.car.details', compact('car'));
    }

    public function delete($id){
        try{
            $car = Car::find($id);
            $car->delete();
            return redirect()->route('admin.car.list')->with('status', 'success')->with('message', 'Car deleted successfully!');

        } catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'error' => $e->getMessage()
            ], 400);
        }

    }

    public function edit($id){
        $car = Car::findOrFail($id);
        return view('backend.admin.car.edit', compact('car'));
    }
}
