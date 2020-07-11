<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trolley extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
