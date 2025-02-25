<?php

namespace App\Models;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rental extends Model
{
    /** @use HasFactory<\Database\Factories\RentalFactory> */
    use HasFactory;

    protected $table = 'rentals';
    protected $fillable = [
        'user_id',
        'car_id',
        'start_date',
        'end_date',
        'total_cost'
    ];

    public function car(){
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
