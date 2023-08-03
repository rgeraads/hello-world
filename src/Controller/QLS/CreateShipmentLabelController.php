<?php

declare(strict_types=1);

namespace App\Controller\QLS;

use App\QLS\Client\QlsClient;
use App\QLS\Order\Order;
use App\QLS\ShipmentLabel\ShipmentLabelMerger;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class CreateShipmentLabelController
{
    public function __construct(
        private QlsClient $qlsClient,
        private ShipmentLabelMerger $shipmentLabelMerger,
        private string $tempPath
    ) {
    }

    #[Route('/qls/shipment/label', methods: ['GET'])]
    public function __invoke(Request $request): BinaryFileResponse
    {
        $productId = (int)$request->query->all('data')['product'];

        $companyId = '9e606e6b-44a4-4a4e-a309-cc70ddd3a103';

        $products = $this->qlsClient->getProducts($companyId);

        foreach ($products as $key => $product) {
            if ($product->getId() !== $productId) {
                continue;
            }

            $shipment = $this->qlsClient->createShipment($companyId, $products[$key]);
        }

        $order = [
            'number' => '#958201',
            'billing_address' => [
                'companyname' => null,
                'name' => 'John Doe',
                'street' => 'Daltonstraat',
                'housenumber' => '65',
                'address_line_2' => '',
                'zipcode' => '3316GD',
                'city' => 'Dordrecht',
                'country' => 'NL',
                'email' => 'email@example.com',
                'phone' => '0101234567',
            ],
            'delivery_address' => [
                'companyname' => '',
                'name' => 'John Doe',
                'street' => 'Daltonstraat',
                'housenumber' => '65',
                'address_line_2' => '',
                'zipcode' => '3316GD',
                'city' => 'Dordrecht',
                'country' => 'NL',
            ],
            'order_lines' => [
                [
                    'amount_ordered' => 2,
                    'name' => 'Jeans - Black - 36',
                    'sku' => 69205,
                    'ean' => '8710552295268',
                ],
                [
                    'amount_ordered' => 1,
                    'name' => 'Sjaal - Rood Oranje',
                    'sku' => 25920,
                    'ean' => '3059943009097',
                ]
            ]
        ];

        $this->qlsClient->downloadShippingLabel($shipment['labels']['a4']['offset_0'], $this->tempPath . '/shipment-label.pdf');
        $path = $this->shipmentLabelMerger->merge($this->tempPath . '/shipment-label.pdf', Order::fromData($order));

        return new BinaryFileResponse($path);
    }
}
