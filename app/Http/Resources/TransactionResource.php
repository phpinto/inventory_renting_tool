<?php

namespace App\Http\Resources;
use App\Transaction;

use Illuminate\Http\Resources\Json\Resource;

class TransactionResource extends Resource
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
            'id' => $this->id,
            'borrowed_at' => $this->borrowed_at,
            'returned_at' => $this->returned_at,
            'user_id' => $this->user_id,
            'item_id' => $this->item_id,
            'item_name' => $this->item->name
        ];
    }

    public function with($request) {
        return [
            'version' => '1.0.0',
            'author_url' => 'Pedro Pinto'
        ];
    }
}
