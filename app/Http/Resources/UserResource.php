<?php

namespace App\Http\Resources;

use App\Models\Auction;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'username' => $this->username,
            'email' => $this->email,
            'last_login_at' => $this->last_login_at,
            'auctions' => UserAuctionResource::collection($this->auctions)
        ];
    }
}
