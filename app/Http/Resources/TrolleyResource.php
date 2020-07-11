<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrolleyResource extends JsonResource
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
            'id'            => $this->id,
            'article'       => $this->inventory->description,
            'img_article'   => $this->inventory->image,
            'quantity'      => $this->quantity,
            'discount'      => $this->discount,
            'unit_total'    => $this->unit_total,
        ];
    }
}
