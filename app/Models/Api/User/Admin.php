<?php

namespace App\Models\Api\User;

use App\Models\Api\Extra\Key;
use App\Models\Api\Main\Picture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Admin extends Model
{
    protected $fillable = [
        'username',
        'name',
        'last',
        'is_super'
    ];

    public static function boot(){
        parent::boot();

        static::creating(function ($model) {
            // $model->slug = str($model->username)->slug() . '-' . mt_rand(10000, 99999);
        });

        static::created(function ($model) {
            $model->key()->create(["value"=>Str::random(10)]);
        });

        static::updating(function ($model) {
            // $model->slug = str($model->username)->slug() . '-' . mt_rand(10000, 99999);
        });
    }

    public function key(){
        return $this->morphOne(Key::class, 'keyable');
    }

    public function photo(){
        return $this->morphOne(Picture::class,'pictureable');
    }

}
