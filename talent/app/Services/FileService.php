<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    public function uploadFile($file, $folder)
    {
        return $file->store($folder, 'public');
    }

    public function deleteFile($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }

    public function getFileUrl($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::url($path);
        }

        return null;
    }
}
