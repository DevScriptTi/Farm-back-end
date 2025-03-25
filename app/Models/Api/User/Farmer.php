<?php

namespace App\Models\Api\User;

use App\Models\Api\Extra\Key;
use App\Models\Api\Main\Farm;
use App\Models\Api\Main\Picture;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    protected $fillable = ['username', 'name', 'last', 'phone', 'date_of_birth'];

    public function key()
    {
        return $this->morphOne(Key::class, 'keyable');
    }

    public function farms()
    {
        return $this->hasMany(Farm::class);
    }

    public function picture()
    {
        return $this->morphOne(Picture::class, 'pictureable');
    }
}
