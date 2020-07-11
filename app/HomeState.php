<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeState extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->morphOne(Order::class, 'orderable');
    }
}
