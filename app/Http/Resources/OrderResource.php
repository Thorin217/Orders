<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TrolleyResource;


class OrderResource extends JsonResource
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
            'customer'          => $this->customer->name,
            'customer_id'       => $this->customer->id,
            'salesman'          => $this->user->name,
            'salesman_id'       => $this->user->id,
            'payment_type'      => $this->payment_type->name,
            'payment_id'        => $this->payment_type->id,
            'delivery_type'     => $this->delivery_type->name,
            'delivery_id'       => $this->delivery_type->id,
            'total'             => $this->total_order,
            'address'           => $this->address,  
            'description'       => $this->description,
            'status'            => $this->status,
            'articles'          => TrolleyResource::collection($this->trolleys),
            'created_at'        => \Carbon\Carbon::parse($this->created_at)->format('Y-m-d H:i A')
        ];
    }

}
