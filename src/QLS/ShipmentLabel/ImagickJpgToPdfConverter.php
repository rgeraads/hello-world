<?php

declare(strict_types=1);

namespace App\QLS\ShipmentLabel;

use Imagick;

final class ImagickJpgToPdfConverter implements JpgToPdfConverter
{
    public function convert(string $source, string $destination): void
    {
        $imagick = new Imagick($source);

        $imagick->setImageFormat('pdf');
        $imagick->writeImages($destination, false);
    }
}
