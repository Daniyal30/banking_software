<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait FileUploadTrait
{
    /**
     * Summary of UploadFile
     * @param mixed $file
     * @param mixed $folder
     * @return array|string
     */
    public function UploadFile($file, $folder = 'profile'){
        $path = $file->store($folder, 'public');
        return $path;
    }

    /**
     * Summary of DeleteFile
     * @param mixed $path
     * @return void
     */
    public function DeleteFile($path){
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
