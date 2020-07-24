<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\DataTable;

class Inventory extends Model
{
    use DataTable;

    protected $guarded = [];

    public static $columns = ['id', 'descripcion', 'precio',  'stock'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeWhereInput( $query, $input )
    {
        if( $input )
        {
            return $query->where( 'description', 'LIKE', '%' . $input . '%')
                        ->orWhere( 'quantity_stock', 'LIKE', '%' . $input . '%')
                        ->orWhere( 'unit_price', 'LIKE', '%' . $input . '%' );
        }
    }
}
