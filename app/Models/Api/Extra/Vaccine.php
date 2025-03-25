<?php

namespace App\Models\Api\Extra;

use App\Models\Api\Main\Animal;
use App\Models\Api\Main\AnimalVaccine;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    protected $fillable = ['name'];

    public function animals()
    {
        return $this->belongsToMany(Animal::class)->using(AnimalVaccine::class)->withPivot('date', 'description');
    }
}
