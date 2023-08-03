<?php

declare(strict_types=1);

namespace App\QLS\ShipmentLabel;

use App\QLS\Order\Order;

interface ImageEditor
{
    public function addOrderInformation(string $source, Order $order, string $destination): void;
}
