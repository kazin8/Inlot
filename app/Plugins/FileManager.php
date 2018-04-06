<?php

namespace App\Plugins;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadeFile;
use Illuminate\Support\Facades\Storage;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManager
{

    /**
     * Load file and return its name.
     *
     * @param UploadedFile $file
     * @param $path
     * @return string
     */
    public static function loadFile(UploadedFile $file, $path)
    {
        $filename = md5(uniqid() . Carbon::now()) . '.' . $file->getClientOriginalExtension();
        Storage::put($path . $filename, FacadeFile::get($file));

        return $filename;
    }

    /**
     * Delete previous file before adding new one.
     */
    public static function deleteFile($fileName, $path)
    {
        if ($fileName) {
            if (self::existsFile($path . $fileName)) {
                Storage::delete($path . $fileName);
            }
        }
    }

    /**
     * Get filename if file exists.
     *
     * @param $path
     * @param $fileName
     * @return null|string
     */
    public static function getFileName($fileName, $path)
    {
        return $fileName ? (self::existsFile($path . $fileName) ? '/static' . $path . $fileName : null) : null;
    }

    /**
     * Check whether file exists.
     *
     * @param $filePath
     * @return bool
     */
    private static function existsFile($filePath)
    {
        return ($filePath and Storage::exists($filePath)) ?: false;
    }

}