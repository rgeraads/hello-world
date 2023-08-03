<?php

declare(strict_types=1);

namespace App\QLS\ShipmentLabel;

use App\QLS\Order\Order;

final class ShipmentLabelMerger
{
    public function __construct(
        private PdfToJpgConverter $pdfToJpgConverter,
        private JpgToPdfConverter $jpgToPdfConverter,
        private ImageEditor $editor,
        private string $tempPath
    ) {
    }

    public function merge(string $source, Order $order): string
    {
        $convertedJpg = $this->tempPath . '/converted.jpg';
        $mergedJpg = $this->tempPath . '/merged.jpg';
        $convertedPdf = $this->tempPath . '/converted.pdf';

        $this->pdfToJpgConverter->convert($source, $convertedJpg);
        $this->editor->addOrderInformation($convertedJpg, $order, $mergedJpg);
        $this->jpgToPdfConverter->convert($mergedJpg, $convertedPdf);

        return $convertedPdf;
    }
}
