<?php

namespace App\Models\backend\Configuration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];


    public function showroomOfAgent()
    {
        return $this->belongsTo(Showroom::class, 'showroom_id', 'id');
    }

}
