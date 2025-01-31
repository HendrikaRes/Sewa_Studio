<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda
    protected $table = 'payment_history';

    // Tentukan kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'user_id',
        'studio_id',
        'amount',
        'payment_date',
        'status',
    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
    // Di model PaymentHistory
public function user()
{
    return $this->belongsTo(User::class);
}

}
