<?php

namespace App\Repository;

use Illuminate\Http\UploadedFile;

class CKEditorRepository
{
    public static function upload(UploadedFile $file, string $dir)
    {
        $name = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($dir), $name);

        return "{$dir}/{$name}";
    }
}
