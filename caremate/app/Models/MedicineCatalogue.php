<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineCatalogue extends Model
{
    //
    protected $table = 'medicine_catalogue';
    protected $primaryKey = 'medicine_id';
    public $timestamps = false;
}
