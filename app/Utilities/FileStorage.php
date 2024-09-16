<?php

namespace App\Utilities;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Image;

class FileStorage
{
    static public function setPhoto($disk, $file){

        $filename=$file->getFilename().'.'.$file->getClientOriginalExtension();

        if (!Storage::disk($disk)->exists($filename)) {
            Storage::disk($disk)->put($filename, File::get($file));
        }

        return $filename;
    }

    static public function setFile($disk, $file,$directory=null){
        $filename=$file->getFilename().'.'.$file->getClientOriginalExtension();
        $directory!=null ?$url=$directory."/".$filename:$url=$filename;
        if (!Storage::disk($disk)->exists($url)) {
            Storage::disk($disk)->put($url, File::get($file));
        }

        return $filename;
    }

    static public function deleteFile($disk, $filename, $directory=null){

        $directory!=null ?$url=$directory."/".$filename:$url=$filename;

        $file_exist=Storage::disk($disk)->exists($url);

        if ($file_exist){
            Storage::disk($disk)->delete($url);
        }

    }

}
