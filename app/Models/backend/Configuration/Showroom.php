<?php

namespace App\Models\backend\Configuration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Showroom extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function cityOfShowroom()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }

}
