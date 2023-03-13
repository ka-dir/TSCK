<?php

namespace App\Models;
use App\Models\Users;

use Illuminate\Database\Eloquent\Model;


/**
 *
 */
class Applicants extends Model
{
    protected $table = 'applicant_details';

    const USER_NOT_FOUND = 1;
    const API_KEY_NOT_FOUND = 2;
    const API_KEY_CLOSED = 3;
    const KEY_SUCCESSFUL = 4;



    public function user()
    {
        return $this->belongsTo(User::class, 'id_no');
    }
}