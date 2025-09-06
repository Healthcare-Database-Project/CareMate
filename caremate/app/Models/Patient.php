<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patient';
    protected $primaryKey = 'patient_id';

    protected $fillable = [
        'users_id',
        'phone',
        'age',
        'sex',
        'address',
        'medical_history',
        'blood_group',
        'emergency_contact',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'users_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id', 'patient_id');
    }

    public function healthInfo()
    {
        return $this->hasMany(HealthInfo::class, 'patient_id', 'patient_id');
    }
}
