<?php

namespace App\Models;

use App\Helpers\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as SpatieRole;
use Illuminate\Database\Eloquent\SoftDeletes;
class Role extends SpatieRole
{
    use HasFactory, SoftDeletes, Searchable;
    
    protected $searchable = [
        'name'
    ];
}
