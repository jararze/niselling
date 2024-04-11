<?php

namespace App\Models\backend\vehicle;

use App\Models\Frontend\Quote;
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

    public function quotes()
    {
        return $this->hasManyThrough(
            Quote::class,
            ModelOfCar::class,
            'id', // Foreign key on the ModelOfCar table...
            'model_of_car_id', // Foreign key on the quotes table...
            'model_of_cars_id', // Local key on the grades table...
            'id' // Local key on the ModelOfCar table...
        );
    }
}
