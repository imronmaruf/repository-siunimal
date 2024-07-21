<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class UploadFile
{
  public static function upload($storageLocation, $file, $namaMahasiswa)
  {
    $file_extension = $file->getClientOriginalExtension();
    // Format nama file dengan nama mahasiswa dan timestamp
    $file_name = $namaMahasiswa . '_' . time() . '.' . $file_extension;

    // Upload file
    $file->move($storageLocation, $file_name);
    $file_url = url("/" . $storageLocation . "/" . $file_name);

    return $file_url;
  }
}
