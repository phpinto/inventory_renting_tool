<?php

namespace App\Http\Resources;
use App\Category;

use Illuminate\Http\Resources\Json\Resource;

class CategoryResource extends Resource
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
            'parent_category' => $this->parent_category,
        ];
    }

    public function with($request) {
        return [
            'version' => '1.0.0',
            'author_url' => 'Pedro Pinto'
        ];
    }
}
