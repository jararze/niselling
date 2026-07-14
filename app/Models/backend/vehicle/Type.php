<?php

namespace App\Models\backend\vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected static function booted(): void
    {
        // Con borrado físico, el ON DELETE CASCADE eliminaba en cadena
        // modelos, versiones y colores y dejaba las cotizaciones colgadas.
        // Con soft delete se cascadea a los modelos (cada uno cascadea a
        // sus colores y versiones) sin destruir datos.
        static::deleted(function (Type $type) {
            if (! $type->isForceDeleting()) {
                $type->modelType()->get()->each->delete();
            }
        });
    }

    public function modelType()
    {
        return $this->hasMany(ModelOfCar::class, 'type_id');
    }
}
