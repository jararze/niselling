<?php

namespace App\Models\backend\vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelOfCar extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
}
