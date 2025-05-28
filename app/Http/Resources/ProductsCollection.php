<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */

    // TODO: Criar a resource
    public function toArray(Request $request): array
    {
        return [
            
        ];
    }

    public function with($request){
        return [];
    }
}
