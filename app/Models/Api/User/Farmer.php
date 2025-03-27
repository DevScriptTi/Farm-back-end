<?php

namespace App\Models\Api\User;

use App\Models\Api\Extra\Key;
use App\Models\Api\Main\Farm;
use App\Models\Api\Main\Picture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Farmer extends Model
{
    protected $fillable = ['username', 'name', 'last', 'phone', 'date_of_birth'];

    public static function boot(){
        parent::boot();
        static::creating(function ($model) {
            $model->username = $model->name . '-' . $model->last.'-' . Str::random(5);
        });
    }
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
    public function getRouteKeyName()
    {
        return 'username';
    }
}
