<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->uuid,
            'description' => $this->description,
            'done' => $this->done,
        ];
    }
}
