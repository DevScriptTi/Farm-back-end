<?php

namespace App\Models\Api\Main;

use App\Models\Api\Extra\AnimalType;
use App\Models\Api\Extra\Illness;
use App\Models\Api\Extra\QRCode;
use App\Models\Api\Extra\Vaccine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QrCodeGenerator;

class Animal extends Model
{
    protected $fillable = ['slug', 'gender', 'weight', 'date_of_birth', 'farm_id', 'animal_type_id'];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public static function boot(){
        parent::boot();
        static::addGlobalScope('animal', function($query){
            if (Auth::check()) {
                $key = Auth::user()->key;
                if ($key->keyable_type == 'farmer') {
                    $query->whereHas('farm', function ($query) {
                        $query->where('farmer_id', Auth::user()->key->keyable_id);
                    });
                }
            }
        });
        static::creating(function($model){
            $model->slug = str()->random(10);
        });
        static::created(function($model){
            $model->qrCode()->create([
                'path' => tap("qrcodes/{$model->slug}.png", function ($path) use ($model) {
                    $storagePath = storage_path("app/public/{$path}");
                    if (!file_exists(dirname($storagePath))) {
                        mkdir(dirname($storagePath), 0755, true);
                    }
                    QrCodeGenerator::format('png')->size(200)->generate($model->slug, $storagePath);
                }),
            ]);
        });
        static::deleting(function($model){
            if ($model->qrCode) {
                $qrCodePath = storage_path('app/public/' . $model->qrCode->path);
                if (file_exists($qrCodePath)) {
                    unlink($qrCodePath);
                }
            }
            $model->qrCode()->delete();

        });
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

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
