<?php

namespace App\Models;

use Dp0\UserActivity\traits\UserActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;
use Str;
class Suspect extends Model
{
    use HasFactory;
    use UserActivity;
    protected $fillable = [
        'name',
        'age',
        'gender',
        'address',
        'nationality',
        'phone',
        'email',
        'description',
        'photo',
        'fir_id',
        'arrest_date',
        'released_date',
        'remarks',
    ];

   public function getPhotoAttribute($value){
        if (Str::startsWith($value, 'https://')) {
            return $value;
        }
        return Storage::url($value);
    }

    public function getFirs(){
        return $this->hasMany(Fir::class,'id','fir_id');
    }
}
