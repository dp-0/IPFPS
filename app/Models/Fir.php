<?php

namespace App\Models;

use App\Helpers\Eloquent\Searchable;
use Dp0\UserActivity\traits\UserActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\HtmlString;

class Fir extends Model
{
    use HasFactory, UserActivity, SoftDeletes, Searchable;

    protected $fillable = [
        'latitude',
        'longitude',
        'address',
        'incident_details',
        'related_to',
        'remarks',
        'clue',
        'complain_by',
        'register_by',
        'investigation_start_date',
        'investigation_end_date',
        'case_number',
        'warrant_number',
        'incident_type_id',
        'priority_id',
        'status_id',
        'reported_at',
        'incident_date',
       
    ];

    protected $searchable = [
        'latitude',
        'longitude',
        'related_to',
        'remarks',
        'address',
        'incident_details',
        'clue',
        'complain_by',
        'register_by',
        'investigation_start_date',
        'investigation_end_date',
        'case_number',
        'warrant_number',
        'incident_type_id',
        'priority_id',
        'status_id',
        'reported_at',
        'incident_date'
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
    public function getPriority(){
        return $this->hasOne(CasePriority::class,'id','priority_id');
    }

}
