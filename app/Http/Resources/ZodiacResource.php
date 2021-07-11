<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ZodiacResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'icon' => $this->icon,
            'magic_number' => $this->magic_number,
            'celebrities' => $this->celebrities,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'calenders' => $this->zodiacCalenders
        ];
    }
}
