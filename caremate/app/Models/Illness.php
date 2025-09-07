<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Illness extends Model
{
    use HasFactory;

    protected $table = 'illness';
    protected $primaryKey = 'illness_id';

    protected $fillable = [
        'illness_name',
        'illness_type',
    ];
}
