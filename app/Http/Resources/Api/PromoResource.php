<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PromoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'judul' => $this->judul,
            'slug' => $this->slug,
            'cover' => $request->getSchemeAndHttpHost() . "/{$this->cover}",
            'konten' => $this->konten,
        ];
    }
}
