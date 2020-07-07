<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'description'   => $this->description,
            'stock'         => $this->quantity_stock,
            'price'         => $this->unit_price,
            'commission'    => $this->percent_commission,
            'category'      => $this->category->name ?? '',
        ];
    }
}
