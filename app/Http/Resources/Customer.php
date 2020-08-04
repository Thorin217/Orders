<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
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
            'id'                => $this->id,
            'name'              => $this->name,
            'business_name'     => $this->business_name,
            //'email'             => $this->email,
            'nit'               => $this->nit,
            'ncr'               => $this->ncr,
            'dui'               => $this->dui,
        ];
    }
}
