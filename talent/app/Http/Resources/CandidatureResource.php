<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CandidatureResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email
            ],
            'offer' => [
                'id' => $this->offerPost->id,
                'title' => $this->offerPost->title
            ],
            'status' => [
                'id' => $this->state->id,
                'name' => $this->state->name,
                'color' => $this->state->color
            ],
            'cv_url' => $this->cv_path ? url('storage/' . $this->cv_path) : null,
            'cover_letter_url' => $this->cover_letter_path ? url('storage/' . $this->cover_letter_path) : null,
            'notes' => $this->notes,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
