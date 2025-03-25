<?php

namespace App\Models\Api\Main;

use App\Models\Api\Extra\Illness;
use Illuminate\Database\Eloquent\Model;

class AnimalIllness extends Model
{
    protected $fillable = ['date', 'description', 'animal_id', 'illness_id'];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function illness()
    {
        return $this->belongsTo(Illness::class);
    }
}
