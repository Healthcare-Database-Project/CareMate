<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineLog extends Model
{
    use HasFactory;

    protected $table = 'medicine_log';

    public $incrementing = false;
    protected $primaryKey = ['mlog_id', 'medicine_id'];
    protected $keyType = 'array';

    protected $fillable = [
        'mlog_id',
        'medicine_id',
        'prescription_start_date',
        'prescription_end_date',
    ];

    protected $casts = [
        'prescription_start_date' => 'date',
        'prescription_end_date' => 'date',
    ];

    public function healthInfo()
    {
        return $this->belongsTo(HealthInfo::class, 'mlog_id', 'info_id');
    }

    public function medicine()
    {
        return $this->belongsTo(MedicineCatalogue::class, 'medicine_id', 'medicine_id');
    }
}
