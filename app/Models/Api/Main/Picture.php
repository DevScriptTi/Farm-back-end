<?php

namespace App\Models\Api\Main;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['path', 'pictureable_id', 'pictureable_type'];

    public function pictureable()
    {
        return $this->morphTo();
    }
}
