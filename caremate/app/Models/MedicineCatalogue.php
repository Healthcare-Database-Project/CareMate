<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineCatalogue extends Model
{
    //
    protected $table = 'medicine_catalogue';
    protected $primaryKey = 'medicine_id';
    public $timestamps = false;

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('common_name', 'like', '%' . request('search') . '%')
                ->orWhere('generic_name', 'like', '%' . request('search') . '%')
                ->orWhere('med_type', 'like', '%' . request('search') . '%');
        }
    }
}
