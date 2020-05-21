<?php


namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait Uploadable
{
    public function upload($file, $storage = 'my_files', $folder = 'uploads')
    {
        if (!empty($file)) {
            $filename = uniqid() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $path = Storage::disk($storage)->putFileAs($folder, $file, $filename);

            if (Storage::disk($storage)->exists($path)) {
                return $path;
            }

            return null;
        } else {
            return null;
        }


    }
}
