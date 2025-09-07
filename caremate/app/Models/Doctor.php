<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctor';
    protected $primaryKey = 'doctor_id';

    protected $fillable = [
        'users_id',
        'bmdc_reg_no',
        'specialization',
        'years_of_experience',
        'consultation_fee',
        'education',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'users_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id', 'doctor_id');
    }

    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id', 'doctor_id');
    }

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class, 'works_at', 'doctor_id', 'hospital_id');
    }
}
