<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable = ['order_id', 'product_id', 'product_name','product_price','product_sales_quantity'];
}
