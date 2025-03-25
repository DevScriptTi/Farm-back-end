<?php

namespace App\Models\Api\Extra;

use App\Models\Api\Main\Animal;
use Illuminate\Database\Eloquent\Model;

class QRCode extends Model
{
    protected $fillable = ['path', 'animal_id'];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
