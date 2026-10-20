<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';
    protected $guarded = ['id'];

    public function rentalDetails()
    {
        return $this->hasMany(RentalDetail::class, 'car_id');
    }
}
