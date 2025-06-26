<?php

namespace App\Models\Api\Main;

use App\Models\Api\Extra\Vaccine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AnimalVaccine extends Pivot
{
    protected $fillable = ['date', 'description', 'animal_id', 'vaccine_id'];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }
}
