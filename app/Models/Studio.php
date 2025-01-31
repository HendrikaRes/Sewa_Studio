<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'facilities', 'price_per_hour', 'image_path'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


// Model Studio
public function paymentHistories()
{
    return $this->hasMany(PaymentHistory::class);
}
}