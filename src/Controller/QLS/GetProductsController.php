<?php

declare(strict_types=1);

namespace App\Controller\QLS;

use App\QLS\Client\QlsClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class GetProductsController
{
    public function __construct(private QlsClient $qlsClient)
    {
    }

    #[Route('/qls/products', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $products = $this->qlsClient->getProducts('9e606e6b-44a4-4a4e-a309-cc70ddd3a103');

        return new JsonResponse(array_map(fn ($product) => $product->toArray(), $products));
    }
}
