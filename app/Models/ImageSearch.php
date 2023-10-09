<?php

namespace App\Models;

use Dp0\UserActivity\traits\UserActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageSearch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'uuid',
        'status',
        'search_percentage',
        'input_image_path',
        'result',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
