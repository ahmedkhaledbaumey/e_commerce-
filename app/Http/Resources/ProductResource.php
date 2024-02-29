<?php

// ProductResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "product_id" => $this->id,
            "product_title" => $this->title,
            "product_desc" => $this->desc,
            "product_price" => $this->price,
            "product_quantity" => $this->quantity,
            "product_image" => asset("storage") . "/" . $this->image,
        ];
    }
}
