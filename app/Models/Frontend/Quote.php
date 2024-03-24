<?php

namespace App\Models\Frontend;

use App\Models\backend\Configuration\Agent;
use App\Models\backend\Configuration\City;
use App\Models\backend\Configuration\Showroom;
use App\Models\backend\vehicle\Grade;
use App\Models\backend\vehicle\ModelOfCar;
use App\Models\backend\vehicle\VehicleColor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'model_of_cars_id',
        'grade_id',
        'showroom_id',
        'city_id',
        'message',
    ];

    public function modelOfCar()
    {
        return $this->belongsTo(ModelOfCar::class, 'model', 'id');
    }


    public function gradeOfCar()
    {
        return $this->belongsTo(Grade::class, 'grade', 'id');
    }

    public function cityOfCar()
    {
        return $this->belongsTo(City::class, 'city', 'id');
    }

    public function showroomOfCar()
    {
        return $this->belongsTo(Showroom::class, 'showroom', 'id');
    }

    public function colorOfCar()
    {
        return $this->belongsTo(VehicleColor::class, 'color', 'color_code');
    }

    public function agentOfCar()
    {
        return $this->belongsTo(Agent::class, 'agent_id', 'id');
    }

}
