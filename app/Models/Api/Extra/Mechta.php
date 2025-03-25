<?php

namespace App\Models\Api\Extra;

use App\Models\Api\Main\Farm;
use Illuminate\Database\Eloquent\Model;

class Mechta extends Model
{
    protected $fillable = ['name', 'baladiya_id'];

    public function baladiya()
    {
        return $this->belongsTo(Baladiya::class);
    }

    public function farms()
    {
        return $this->hasMany(Farm::class);
    }
}
