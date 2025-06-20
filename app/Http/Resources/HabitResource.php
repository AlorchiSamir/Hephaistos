<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HabitResource extends JsonResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
        self::withoutWrapping();
    }

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => ucfirst($this->name),
            'description' => $this->description,
        ];
    }
}
