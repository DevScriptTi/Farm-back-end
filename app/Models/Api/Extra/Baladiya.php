<?php

namespace App\Models\Api\Extra;

use Illuminate\Database\Eloquent\Model;

class Baladiya extends Model
{
    protected $fillable = ['name', 'wilaya_id'];

    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class);
    }

    public function mechtas()
    {
        return $this->hasMany(Mechta::class);
    }
}
