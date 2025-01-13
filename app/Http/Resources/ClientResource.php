<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'picture' => $this->picture,
            'redirect_urls' => explode(',', $this->redirect),
            'secret' => $this->when($request->method() === 'POST', $this->secret),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
