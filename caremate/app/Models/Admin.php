<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'users_id',
        'admin_level',
        'department',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'users_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'admin_id', 'admin_id');
    }

    public function hospitals()
    {
        return $this->belongsToMany(Hospital::class, 'has_access', 'admin_id', 'hospital_id');
    }
}
