<?php

namespace App\Models;

use App\Helpers\Eloquent\Searchable;
use Dp0\UserActivity\traits\UserActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;
class Evidence extends Model
{
    use HasFactory, UserActivity, SoftDeletes;

    protected $fillable = [
        'fir_id',
        'description',
        'type',
        'collected_by',
        'collected_at',
        'preserved_by',
        'preserved_at',
        'attachment_path',
    ];
    public function getShortDescriptionAttribute()
    {
        return Str::limit($this->description, 100, ' ....');
    }
    public function collectedBy(){
        return $this->hasOne(User::class, 'id', 'collected_by');
    }
    public function preservedBy(){
        return $this->hasOne(User::class, 'id','preserved_by');
    }
}
