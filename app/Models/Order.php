<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_id', 'shipping_id', 'payment_id', 'total', 'status'];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function shipping() {
        return $this->belongsTo(Shipping::class);
    }

    public function payment() {
        return $this->belongsTo(Payment::class);
    }

}
