<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'client_id' => $this->client_id,
            'total' => $this->total,
            'doc_type' => $this->doc_type,
            'doc_number' => $this->doc_number,
            'order_id' => $this->order_id
        ];
    }
}
