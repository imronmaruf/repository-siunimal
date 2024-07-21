<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class DeleteFile
{

  public static function delete($name_file)
  {
    $publicPath = public_path();
    $file_path = $publicPath . '/' . $name_file;

    if (File::exists($file_path)) {
      return File::delete($file_path);
    }

    return false;
  }
}
