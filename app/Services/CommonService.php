<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class CommonService
{
    public function getImageUrl($request, $fileRequestName, $folderName)
    {
        if ($request->hasFile($fileRequestName)) {

            $file = $request->file($fileRequestName);
            $name = str_replace(' ', '_', $request['name']);
            $fileName = "{$name}_{$file->hashName()}";
            $path = $request->file($fileRequestName)->storeAs($folderName, $fileName);
            $imageUrl = Storage::url($path);
            return $imageUrl;
        }
    }
}
