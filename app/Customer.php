<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\DataTable;

class Customer extends Model
{
    use DataTable;

    protected $guarded = [];

    public static $columns = ['id', 'descripcion', 'precio',  'stock'];

    public function getFullNameAttribute($value)
    {
        return $this->contact_first_name . ' ' . $this->contact_last_name;
    }

    public function typecustomer()
    {
        return $this->belongsTo('App\TypeCustomer', 'type_customer_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
