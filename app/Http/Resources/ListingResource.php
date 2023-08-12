<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'company' => $this->company,
            'location' => $this->location,
            'email' => $this->email,
            'website' => $this->website,
            'description' => $this->description,
        ];
    }
}
