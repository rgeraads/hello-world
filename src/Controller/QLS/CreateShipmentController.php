<?php

declare(strict_types=1);

namespace App\Controller\QLS;

use App\QLS\Client\QlsClient;
use App\QLS\Product\Product;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class CreateShipmentController
{
    public function __construct(private QlsClient $qlsClient)
    {
    }

    #[Route('/qls/shipment', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $product = Product::fromData($request->request->all('product'));

        $shipment = $this->qlsClient->createShipment('9e606e6b-44a4-4a4e-a309-cc70ddd3a103', $product);

        return new JsonResponse($shipment);
    }
}
