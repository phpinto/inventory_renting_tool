<?php

namespace App\Http\Resources;
use App\Item;
use App\Category;

use Illuminate\Http\Resources\Json\Resource;

class ItemResource extends Resource
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
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category->name,
            'team' => $this->team,
            'available' => $this->available,
            'total' => $this->total,
            'building' => $this->location->building,
            'room' => $this->location->room,
            'cabinet' => $this->location->cabinet,
            'drawer' => $this->location->drawer,
            'container' => $this->location->container,
            'manufacturer' => $this->location->manufacturer,
            'model' => $this->location->model,
            'vendor' => $this->location->vendor,
            'purchase_date' => $this->location->purchase_date,
            'receipt_folder' => $this->location->receipt_folder,
        ];
    }

    public function with($request) {
        return [
            'version' => '1.0.0',
            'author_url' => 'Pedro Pinto'
        ];
    }
}
