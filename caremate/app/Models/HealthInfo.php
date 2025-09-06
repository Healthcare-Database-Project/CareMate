<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthInfo extends Model
{
    use HasFactory;

    protected $table = 'health_info';
    protected $primaryKey = 'info_id';

    protected $fillable = [
        'date_of_recording',
        'time_of_recording',
        'patient_id',
    ];

    protected $casts = [
        'date_of_recording' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }

    public function medicineLog()
    {
        return $this->hasMany(MedicineLog::class, 'mlog_id', 'info_id');
    }

    public function bloodSugarLevel()
    {
        return $this->hasOne(BloodSugarLevel::class, 'b_sugar_id', 'info_id');
    }

    public function bloodPressure()
    {
        return $this->hasOne(BloodPressure::class, 'bp_id', 'info_id');
    }

    public function bodyTemperature()
    {
        return $this->hasOne(BodyTemperature::class, 'bt_id', 'info_id');
    }
}
