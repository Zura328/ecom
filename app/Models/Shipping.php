<?php

// app/Models/Shipping.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
        'order_id', 'delivery_guy_id', 'payment_mode', 'shipping_address','shipping_method','status'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function deliveryGuy()
    {
        return $this->belongsTo(User::class, 'delivery_guy_id');
    }
}
