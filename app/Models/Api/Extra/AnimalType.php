<?php

namespace App\Models\Api\Extra;

use App\Models\Api\Main\Animal;
use Illuminate\Database\Eloquent\Model;

class AnimalType extends Model
{
    protected $fillable = ['slug', 'name'];

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
