<?php

namespace Modules\Car\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'model' => $this->model,
            'brand' => $this->brand,
        ];
    }
}
