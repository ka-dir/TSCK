<?php

namespace App\Models;
use App\Models\Users;

use Illuminate\Database\Eloquent\Model;


/**
 *
 */
class ApiKeys extends Model
{
    protected $table = 'api_auth';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

}