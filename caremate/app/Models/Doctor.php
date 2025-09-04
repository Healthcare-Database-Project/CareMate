<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialization',
        'experience',
        'phone',
        'email',
        'available_days',
        'available_times'
    ];

    protected $casts = [
        'available_days' => 'array',
        'available_times' => 'array'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
