<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
        's_first_name', 's_last_name','s_email', 's_address','s_city','s_country', 's_zip', 's_ztelephone'
    ];
}
