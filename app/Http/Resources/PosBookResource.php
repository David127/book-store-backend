<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PosBookResource extends JsonResource
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
            'id' => $this->book_id,
            'isbn' => $this->isbn,
            'name' => $this->name,
            'stock' => $this->stock,
            'currentPrice' => $this->current_price,
            'image' => $this->image
        ];
    }
}
