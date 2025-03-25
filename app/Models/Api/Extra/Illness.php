<?php

namespace App\Models\Api\Extra;

use App\Models\Api\Main\Animal;
use App\Models\Api\Main\AnimalIllness;
use Illuminate\Database\Eloquent\Model;

class Illness extends Model
{
    protected $fillable = ['name', 'description'];

    public function animals()
    {
        return $this->belongsToMany(Animal::class)->using(AnimalIllness::class)->withPivot('date', 'description');
    }
}
