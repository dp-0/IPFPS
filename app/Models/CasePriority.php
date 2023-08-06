<?php

namespace App\Models;

use App\Helpers\Eloquent\Searchable;
use Dp0\UserActivity\traits\UserActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CasePriority extends Model
{
    use HasFactory;
    use SoftDeletes;
    use UserActivity;
    use Searchable;

    protected $searchable = [
      'name'
    ];

    protected $fillable = [
        'name',
        'priority'
    ];
}
