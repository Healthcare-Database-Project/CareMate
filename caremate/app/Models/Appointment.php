<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointment';
    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'admin_id',
        'appointment_status',
        'appointment_date',
        'appointment_time',
        'serial_no',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'doctor_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'admin_id');
    }
}
