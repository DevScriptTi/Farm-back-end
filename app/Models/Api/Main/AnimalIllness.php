<?php

namespace App\Models\Api\Main;

use App\Models\Api\Extra\Illness;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AnimalIllness extends Pivot
{
    protected $fillable = ['date', 'description', 'animal_id', 'illness_id'];

    protected $table = 'animal_illnesses';
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function illness()
    {
        return $this->belongsTo(Illness::class);
    }
}
