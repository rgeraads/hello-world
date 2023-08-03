<?php

declare(strict_types=1);

namespace App\QLS\ShipmentLabel;

use App\QLS\Order\Order;

final class ShipmentLabelMerger
{
    public function __construct(
        private PdfToJpgConverter $converter,
        private ImageEditor $editor,
        private string $tempPath
    ) {
    }

    public function merge(string $source, Order $order): string
    {
        $convertedPath = $this->tempPath . '/converted.jpg';
        $mergedPath = $this->tempPath . '/merged.jpg';

        $this->converter->convert($source, $convertedPath);
        $this->editor->addOrderInformation($convertedPath, $order, $mergedPath);

        return $mergedPath;
    }
}
