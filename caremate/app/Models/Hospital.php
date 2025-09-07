<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $table = 'hospital';
    protected $primaryKey = 'hospital_id';

    protected $fillable = [
        'hospital_name',
        'location',
        'phone',
        'email',
        'type',
    ];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'works_at', 'hospital_id', 'doctor_id');
    }

    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'has_access', 'hospital_id', 'admin_id');
    }
}
