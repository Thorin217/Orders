<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
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
            'created'       => $this->created,
            'processing'   => $this->processing,
            'in_route'      => $this->in_route,
            'delivered'     => $this->delivered,
            'cancelled'     => $this->cancelled
        ];
    }
}
