<?php

namespace App\Servers\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\Resources\ModuleResource;

/**
 */
class ServerResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'assetId' => $this->asset_id,
            'brand' => $this->brand,
            'name' => $this->name,
            'price' => (float)$this->price,
            'valid' => (bool)$this->valid,
            'modules' => ModuleResource::collection($this->modules),
        ];
    }
}
