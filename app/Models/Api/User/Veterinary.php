<?php

namespace App\Models\Api\User;

use App\Models\Api\Extra\Baladiya;
use App\Models\Api\Extra\Key;
use App\Models\Api\Main\Picture;
use Illuminate\Database\Eloquent\Model;

class Veterinary extends Model
{
    protected $fillable = [
        'name',
        'last',
        'username',
        'phone',
        'email',
        'academic_degree',
        'license_number',
        'clinic_location',
        'baladiya_id',
    ];

    public function baladiya()
    {
        return $this->belongsTo(Baladiya::class);
    }
    public function key()
    {
        return $this->morphOne(Key::class, 'keyable');
    }

    public function photo()
    {
        return $this->morphOne(Picture::class, 'pictureable');
    }
}
