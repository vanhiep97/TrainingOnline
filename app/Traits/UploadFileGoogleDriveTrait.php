<?php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadFileGoogleDriveTrait
{
    public function uploadFileDrive($name)
    {
        $file = $name;
        $fileName = time() . $file->getClientOriginalName();
        $file->storeAs('/', $fileName, 'google');
        return $fileName;
    }

    public function deleteFileDrive($filename)
    {
        $dir = '/';
        $recursive = false;
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            ->first();
        if (!empty($file)) {
            Storage::cloud()->delete($file['path']);
            return true;
        } else {
            return false;
        }
    }
}
