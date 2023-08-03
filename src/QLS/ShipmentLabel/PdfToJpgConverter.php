<?php

declare(strict_types=1);

namespace App\QLS\ShipmentLabel;

interface PdfToJpgConverter
{
    public function convert(string $source, string $destination): void;
}
