<?php

namespace App\Models\backend\vehicle;

use App\Models\Frontend\Quote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelOfCar extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected static function booted(): void
    {
        // El soft delete no dispara el ON DELETE CASCADE de la base de datos:
        // sin esta cascada los colores y versiones quedan activos apuntando
        // a un modelo borrado y rompen las vistas que acceden a la relación.
        static::deleted(function (ModelOfCar $model) {
            if (! $model->isForceDeleting()) {
                $model->colors()->delete();
                $model->grades()->delete();
            }
        });
    }

    public function typeOfCar()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'model_of_cars_id');
    }

    public function colors()
    {
        return $this->hasMany(VehicleColor::class, 'model_of_cars_id');
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class, 'model');
    }

}
