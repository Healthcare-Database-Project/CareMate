<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodSugarLevel extends Model
{
    use HasFactory;

    protected $table = 'blood_sugar_level';
    protected $primaryKey = 'b_sugar_id';
    public $incrementing = false;

    protected $fillable = [
        'b_sugar_id',
        'blood_sugar_level',
    ];

    public function healthInfo()
    {
        return $this->belongsTo(HealthInfo::class, 'b_sugar_id', 'info_id');
    }
}
