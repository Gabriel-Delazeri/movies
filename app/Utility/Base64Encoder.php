<?php

namespace App\Utility;

class Base64Encoder
{
    /**
     * @param string $imageDecoded
     * @return string
     */
    public static function encodeImage(string $imageDecoded): string
    {
        return 'data:image/png;base64,' . base64_encode($imageDecoded);
    }
}
