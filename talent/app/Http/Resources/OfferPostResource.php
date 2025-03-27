<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferPostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'type' => $this->type,
            'salary' => $this->salary,
            'deadline' => $this->deadline->format('Y-m-d'),
            'is_active' => $this->is_active,
            'recruiter' => [
                'id' => $this->user->id,
                'name' => $this->user->name
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
