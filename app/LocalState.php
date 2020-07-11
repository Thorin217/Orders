<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalState extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->morphOne(Order::class, 'orderable');
    }
}
