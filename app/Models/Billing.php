<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    protected $fillable = [
           'b_first_name', 'b_last_name','b_email', 'b_address','b_city','b_country', 'b_zip', 'b_telephone'
        ];
}
