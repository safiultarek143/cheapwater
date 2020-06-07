<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const PAYMENT_PAID = 1;
    const PAYMENT_PENDING = 2;

    protected $fillable = ['payment_method', 'payment_status','amount','transaction_id'];
}
