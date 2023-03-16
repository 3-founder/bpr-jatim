<?php

namespace App\Repository;

use App\Models\Jumbotron;
use Illuminate\Http\UploadedFile;

class JumbotronRepository
{
    public const FILEPATH = 'public/upload/jumbotron';

    public static function add(UploadedFile $file): Jumbotron
    {
        $image = static::upload($file);
        return Jumbotron::create(compact('image'));
    }

    private static function upload(UploadedFile $file): string
    {
        $name = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path(self::FILEPATH), $name);

        return self::FILEPATH . "/{$name}";
    }
}
