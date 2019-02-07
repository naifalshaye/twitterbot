<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;

class GuestController extends Controller
{
    public function showImage($filename)
    {
        return Image::make(storage_path('app/public/images/' . $filename))->response();
    }
}
