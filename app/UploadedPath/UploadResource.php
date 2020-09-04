<?php
/**
 * Created by PhpStorm.
 * User: HOME
 * Date: 22.06.2018
 * Time: 10:05
 */

namespace App\UploadedPath;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\UploadedFile;



class UploadResource
{

    public static function getUniqueName(UploadedFile $file)
    {
        return $newname = date('Y-m-d') . '_' . time() . '_' . str_replace(" ", "_", $file->getClientOriginalName());
    }
}