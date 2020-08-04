<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\StatusResource;
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
            'salesman'          => $this->user->name,
            'payment_type'      => $this->payment_type->name,
            'delivery_type'     => $this->delivery_type->name,
            'total'             => $this->total_order,
            'address'           => $this->address,
            'description'       => $this->description,
            'status'            => new StatusResource($this->orderable),
            'articles'          => TrolleyResource::collection($this->trolleys),
            'created_at'        => \Carbon\Carbon::parse($this->created_at)->format('Y-m-d H:i A')
        ];
    }
}
