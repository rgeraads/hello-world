<?php

declare(strict_types=1);

namespace App\QLS\Client;

use App\QLS\Product\Product;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

final class GuzzleQlsClient implements QlsClient
{
    public function __construct(private Client $client)
    {
    }

    public function getProducts(string $companyId): array
    {
        try {
            $response = $this->client->get(sprintf('/companies/%s/products', $companyId));

            $products = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR)['data'];

            return array_map(fn ($product) => Product::fromData($product), $products);
        } catch (GuzzleException|JsonException $e) {
            throw new QlsClientException($e->getMessage());
        }
    }

    public function createShipment(string $companyId, Product $product): array
    {
        $body = [
            'weight' => 1000,
            'brand_id' => 'e41c8d26-bdfd-4999-9086-e5939d67ae28',
            'product_id' => $product->getId(),
            'product_combination_id' => current($product->getCombinations())['id'],
            'cod_amount' => 0,
            'piece_total' => 1,
            'reference' => 'foo',
            'receiver_contact' => [
                'name' => 'Randy',
                'companyname' => 'Randy\'s company',
                'street' => 'Jasmijnstraat',
                'housenumber' => '38',
                'postalcode' => '3353CH',
                'locality' => 'NL',
                'country' => 'NL',
            ],
            'shipment_products' => [
                'amount' => 1,
                'name' => 'foo',
                'country_code_of_origin' => 'NL',
                'hs_code' => 'bla',
                'price_per_unit' => 1,
                'weight_per_unit' => 1000,
            ],
        ];

        try {
            $response = $this->client->post(sprintf('/companies/%s/shipments', $companyId), ['json' => $body]);

            return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR)['data'];
        } catch (GuzzleException|JsonException $e) {
            throw new QlsClientException($e->getMessage());
        }
    }

    /**
     * @throws QlsClientException
     */
    public function downloadShippingLabel(string $url, string $destination): void
    {
        try {
            $this->client->get($url, ['sink' => $destination]);
        } catch (GuzzleException $e) {
            throw new QlsClientException($e->getMessage());
        }
    }
}
