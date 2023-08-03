<?php

declare(strict_types=1);

namespace App\QLS\ShipmentLabel;

use App\QLS\Order\Order;
use App\QLS\Order\OrderLine;

use function imagecolorallocate;
use function imagecreatefromjpeg;
use function imagedestroy;
use function imagejpeg;
use function imagettftext;

final class ImageMagickImageEditor implements ImageEditor
{
    public function addOrderInformation(string $source, Order $order, string $destination): void
    {
        $image = imagecreatefromjpeg($source);
        $color = imagecolorallocate($image, 0, 0, 0);

        $text = '';
        foreach ($order->getOrderLines() as $orderLine) {
            $text .= self::formatOrderLine($orderLine);
        }

        imagettftext($image, 16, 0, 75, 1300, $color, __DIR__ . '/Anonymous.ttf', $text);
        imagejpeg($image, $destination);
        imagedestroy($image);
    }

    private static function formatOrderLine(OrderLine $orderLine): string
    {
        return <<<EOT
Product: {$orderLine->getName()}
Amount:  {$orderLine->getAmountOrdered()}
EAN:     {$orderLine->getEan()}
SKU:     {$orderLine->getSku()}


EOT;
    }
}
