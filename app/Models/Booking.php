<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Menambahkan 'user_id' ke dalam kolom yang dapat diisi secara massal
    protected $fillable = ['studio_id', 'start_time', 'end_time', 'user_id'];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}