<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodPressure extends Model
{
    use HasFactory;

    protected $table = 'blood_pressure';
    protected $primaryKey = 'bp_id';
    public $incrementing = false;

    protected $fillable = [
        'bp_id',
        'blood_pressure',
    ];

    public function healthInfo()
    {
        return $this->belongsTo(HealthInfo::class, 'bp_id', 'info_id');
    }
}
