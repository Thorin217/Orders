<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function trolleys()
    {
        return $this->hasMany(Trolley::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment_type()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function delivery_type()
    {
        return $this->belongsTo(DeliveryType::class);
    }

    public function ScopeIsProcessing($query)
    {
        # code...
    }
}
