<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileHandlerService
{
    /**
     * handleUpload
     *
     * @return void
     */
    public function handleUpload(mixed $file, string $path)
    {
        $mime = $file->getClientOriginalExtension();
        $newName = Str::random(64);

        return Storage::put($path, $file);
    }

    /**
     * handleRemove
     *
     * @param  string  $image_path
     * @return void
     */
    public function handleRemove($image_path)
    {
        if (! is_null($image_path)) {
            return Storage::delete($image_path);
        }

        return false;
    }
}
