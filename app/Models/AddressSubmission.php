<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressSubmission extends Model
{
    protected $fillable = [
        'user_name',
        'province_id','district_id','commune_id','village_id',
        'province_name','district_name','commune_name','village_name',
    ];
}
