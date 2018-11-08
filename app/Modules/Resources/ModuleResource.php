<?php

namespace App\Modules\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

/**
 */
class ModuleResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'serverId' => $this->server_id,
            'type' => $this->type,
            'size' => $this->size
        ];
    }
}