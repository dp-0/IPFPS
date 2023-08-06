<?php

namespace App\Models;

use Dp0\UserActivity\traits\UserActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Witness extends Model
{
    use HasFactory;

    use UserActivity;

    protected $fillable = [
        'fir_id',
        'name',
        'contact_number',
        'address',
        'statement',
    ];
}
