<?php

namespace App\Helpers;

class AssetPathHelper
{
    public static function assetPath($asset_path) : String
    {
        $use_public_url = env('USE_PUBLIC_URL', false);
        if ($use_public_url) {
            if (!str_contains($asset_path, 'public/')) {
                $asset_path = 'public/'.$asset_path;
            }
        }
        else{
            $asset_path = str_replace('public/', '', $asset_path);
        }

        return $asset_path;
    }
}
