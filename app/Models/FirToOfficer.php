<?php

namespace App\Models;

use Dp0\UserActivity\traits\UserActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FirToOfficer extends Model
{
    use HasFactory, SoftDeletes, UserActivity;

    protected $fillable = [
        'fir_id',
        'user_id',
        'start_date',
        'end_date'
    ];

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
