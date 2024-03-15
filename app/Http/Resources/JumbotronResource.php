<?php

namespace App\Http\Resources;

use App\Helpers\AssetPathHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class JumbotronResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $asset_path = $request->getSchemeAndHttpHost() . "/{$this->image}";
        $asset_path = AssetPathHelper::assetPath($asset_path);
        return [
            'created_at' => $this->created_at,
            'image' => $asset_path,
        ];
    }
}
