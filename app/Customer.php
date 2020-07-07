<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function getFullNameAttribute($value)
    {
        return $this->contact_first_name . ' ' . $this->contact_last_name;
    }

    public function typecustomer()
    {
        return $this->belongsTo('App\TypeCustomer', 'type_customer_id', 'id');
    }
}
