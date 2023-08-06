<?php

namespace App\Models;

use App\Helpers\Eloquent\Searchable;
use Dp0\UserActivity\traits\UserActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\HtmlString;

class Complain extends Model
{
    use HasFactory, UserActivity, SoftDeletes, Searchable;

    protected $fillable = [
        'title',
        'latitude',
        'longitude',
        'address',
        'complain_details',
        'complain_number',
        'reported_at',
        'incident_date',
        'register_by',
        'complain_by',
        'incident_type_id',
        'status_id',
    ];

    protected $searchable = [
        'title',
        'latitude',
        'longitude',
        'address',
        'complain_details',
        'complain_number',
        'reported_at',
        'incident_date',
        'getRegisterBy.name',
        'getComplainBy.name',
        'getIncidentType.name',
        'getStatus.name',
    ];

    public function getComplainBy(){
        return $this->hasOne(Complainants::class,'id','complain_by');
    }
    public function getRegisterBy(){
        return $this->hasOne(User::class,'id','register_by');
    }
    public function getIncidentType(){
        return $this->hasOne(IncidentType::class,'id','incident_type_id');
    }
    public function getStatus(){
        return $this->hasOne(FirStatus::class,'id','status_id');
    }
    public function getComplainDetailsAttribute($value){
        return new HtmlString($value);
    }
}
