<?php

namespace App\Models\backend\vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function modelType()
    {
        return $this->hasMany(ModelOfCar::class, 'type_id');
    }
}
