<?php

namespace App\Models\backend\vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelOfCar extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];


    public function typeOfCar()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'model_of_cars_id');
    }

}