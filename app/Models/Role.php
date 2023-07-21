<?php

namespace App\Models;

use App\Helpers\Eloquent\Except;
use App\Helpers\Eloquent\Searchable;
use Dp0\UserActivity\traits\UserActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\SoftDeletes;
class Role extends SpatieRole
{
    use HasFactory, SoftDeletes, Searchable, Except, UserActivity;
    
    protected $searchable = [
        'name'
    ];

    protected $except =[
        'name'
    ];
}
