<?php

namespace App\Models;
use App\Models\Adverts;
use App\Models\AppliedJobs;

use Illuminate\Database\Eloquent\Model;


/**
 *
 */
class Users extends Model
{
    protected $table = 'users';


    public function adverts()
    {
        return $this->hasMany(Adverts::class);
    }

    public function applicants()
    {
        return $this->hasOne(Applicants::class);
    }

    public function apliedjobs()
    {
        return $this->hasMany(AppliedJobs::class);
    }

    public function getAppliedAttribute()
    {
        return $this->apliedjobs()->where('id_number',$this->id_number);
    }

    public function getApplicantAttribute()
    {
        return $this->applicants()->where('id_no',$this->id_number);
    }



}