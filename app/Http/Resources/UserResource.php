<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "role" => $this->role,
            'active_client_sessions' => ClientResource::collection($this->whenLoaded('active_client_sessions')),
            "clients" => ClientResource::collection($this->whenLoaded('clients')),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
