<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuctionResource extends JsonResource
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
            'id' => $this->id,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'user' => [
                'id' => $this->user->id,
                'created_at' => $this->user->created_at,
                'name' => $this->user->name,
                'phone' => $this->user->num_phone
            ],
            'book' => [
                'id' => $this->book->id,
                'title' => $this->book->title,
                'description' => $this->book->description,
                'category' => $this->book->category->name,
                'book_condition' => $this->book->bookCondition->value,
            ],
            'images' => $this->images
        ];
    }
}
