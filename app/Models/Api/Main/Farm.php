<?php

namespace App\Models\Api\Main;

use App\Models\Api\Extra\Mechta;
use App\Models\Api\User\Farmer;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    protected $fillable = ['slug', 'name', 'mechta_id', 'farmer_id'];

    public function mechta()
    {
        return $this->belongsTo(Mechta::class);
    }

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
