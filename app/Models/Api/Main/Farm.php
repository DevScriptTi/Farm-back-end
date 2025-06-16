<?php

namespace App\Models\Api\Main;

use App\Models\Api\Extra\Mechta;
use App\Models\Api\User\Farmer;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Farm extends Model
{
    protected $fillable = ['name', 'mechta_id', 'farmer_id'];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope('farmer', function (Builder $builder) {
            if (Auth::check()) {
                $key = Auth::user()->key;
                if ($key && $key->keyable_type === "farmer") {
                    $builder->where('farmer_id', $key->keyable_id);
                }
            }
        });
        static::creating(function ($model) {
            // $model->slug = str()->slug($model->name.'-'.Str::random(5));
            if (Auth::check()) {
                $key = Auth::user()->key;
                if ($key && $key->keyable_type === "farmer") {
                    $model->farmer_id = $key->keyable_id;
                }
            }
        });
        static::updating(function ($model) {
            // $model->slug = str()->slug($model->name.'-'.Str::random(5));
            if (Auth::check()) {
                $key = Auth::user()->key;
                if ($key && $key->keyable_type === "farmer") {
                    $model->farmer_id = $key->keyable_id;
                }
            }
        });
    }

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
