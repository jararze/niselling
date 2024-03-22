<?php

namespace App\Models\backend\vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\backend\vehicle\ModelOfCar;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];


    public function modelOfCar()
    {
        return $this->belongsTo(ModelOfCar::class, 'model_of_cars_id', 'id');
    }


}
