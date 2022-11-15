<?php

namespace App\Utility;

use App\Utility\Contracts\ImageFilenameInterface;
use Illuminate\Support\Str;

class BackdropFilename implements ImageFilenameInterface
{
    /**
     * @var
     */
    public $filename;

    /**
     * @param string $imageName
     * @return void
     */
    public function setFilename(string $imageName) : void
    {
        $this->filename = Str::slug($imageName . '_backdrop') . time() . '.png';
    }
}
