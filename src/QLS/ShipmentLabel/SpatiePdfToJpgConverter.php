<?php

declare(strict_types=1);

namespace App\QLS\ShipmentLabel;

use Spatie\PdfToImage\Pdf;

final class SpatiePdfToJpgConverter implements PdfToJpgConverter
{
    public function convert(string $source, string $destination): void
    {
        $pdf = new Pdf($source);

        $pdf->setOutputFormat('jpg');
        $pdf->saveImage($destination);
    }
}
