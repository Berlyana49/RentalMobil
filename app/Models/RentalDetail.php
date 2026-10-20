<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RentalDetail extends Model
{
    use HasFactory;

    protected $table = 'rental_details';
    protected $guarded = ['id'];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function rental()
    {
        return $this->belongsTo(Rental::class, 'rental_id');
    }
}
