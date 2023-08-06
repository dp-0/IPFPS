<?php

namespace App\Models;

use App\Helpers\Eloquent\Searchable;
use Dp0\UserActivity\traits\UserActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class Complainants extends Model
{
    use HasFactory, SoftDeletes, UserActivity, Searchable;

    protected  $fillable = [
        'name',
        'address',
        'mobile_no',
        'profile_photo_path'
    ];

    protected  $searchable = [
        'id',
        'name',
        'address',
        'mobile_no',
        'profile_photo_path'
    ];
    public function getProfilePhotoPathAttribute($value)
    {
        if (Str::startsWith($value, 'https://')) {
            return $value;
        }
        return Storage::url($value);
    }
}
