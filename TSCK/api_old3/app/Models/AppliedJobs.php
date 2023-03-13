<?php

namespace App\Models;
use App\Models\Users;

use Illuminate\Database\Eloquent\Model;


/**
 *
 */
class AppliedJobs extends Model
{
    protected $table = 'tblappliedjobs';


    public function user()
    {
        return $this->belongsTo(User::class, 'id_number');
    }
}