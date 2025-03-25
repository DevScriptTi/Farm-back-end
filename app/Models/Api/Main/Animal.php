<?php

namespace App\Models\Api\Main;

use App\Models\Api\Extra\AnimalType;
use App\Models\Api\Extra\Illness;
use App\Models\Api\Extra\QRCode;
use App\Models\Api\Extra\Vaccine;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = ['slug', 'gender', 'weight', 'date_of_birth', 'farm_id', 'animal_type_id'];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function animalType()
    {
        return $this->belongsTo(AnimalType::class);
    }

    public function illnesses()
    {
        return $this->belongsToMany(Illness::class)->using(AnimalIllness::class)->withPivot('date', 'description');
    }

    public function vaccines()
    {
        return $this->belongsToMany(Vaccine::class)->using(AnimalVaccine::class)->withPivot('date', 'description');
    }

    public function picture()
    {
        return $this->morphOne(Picture::class, 'pictureable');
    }

    public function qrCode()
    {
        return $this->hasOne(QRCode::class);
    }
}
