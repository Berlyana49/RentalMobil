<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rental extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function rentalDetails()
    {
        return $this->hasMany(RentalDetail::class, 'rental_id');
    }
}
