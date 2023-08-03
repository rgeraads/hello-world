<?php

declare(strict_types=1);

namespace App\QLS\Client;

use App\QLS\Product\Product;

interface QlsClient
{
    /**
     * @return Product[]
     *
     * @throws QlsClientException
     */
    public function getProducts(string $companyId): array;

    /**
     * @return array{mixed,mixed}
     *
     * @throws QlsClientException
     */
    public function createShipment(string $companyId, Product $product): array;

    public function downloadShippingLabel(string $url, string $destination): void;
}
