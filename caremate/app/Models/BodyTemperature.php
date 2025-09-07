<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyTemperature extends Model
{
    use HasFactory;

    protected $table = 'body_temperature';
    protected $primaryKey = 'bt_id';
    public $incrementing = false;

    protected $fillable = [
        'bt_id',
        'body_temperature',
    ];

    public function healthInfo()
    {
        return $this->belongsTo(HealthInfo::class, 'bt_id', 'info_id');
    }
}
