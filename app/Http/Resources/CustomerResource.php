<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'type'              => $this->typecustomer->name,
            'business_name'     => $this->business_name,
            'contact_name'      => $this->fullname,
            'telephone'         => $this->telephone,
            'cellphone'         => $this->cellphone,
            'address'           => $this->address,
            'ncr'               => $this->ncr,
            'nit'               => $this->nit,
            'dui'               => $this->dui,
            'attached'          => $this->attached,
            'created_at'        => $this->created_at
        ];
    }
}
