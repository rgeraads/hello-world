<?php

declare(strict_types=1);

namespace App\QLS\Client;

use App\QLS\Product\Product;

final class FixtureQlsClient implements QlsClient
{
    public function getProducts(string $companyId): array
    {
        return [
            Product::fromData([
                'id' => 2,
                'name' => 'DHL Pakje',
                'type' => 'delivery',
                'servicepoint' => false,
                'max_height' => 350,
                'max_length' => 800,
                'max_width' => 500,
                'pricing' => [
                    [
                        'id' => 3,
                        'country' => 'NL',
                        'weight_min' => 0,
                        'weight_max' => 1000,
                        'price' => 9.99,
                    ],
                    [
                        'id' => 2,
                        'country' => 'NL',
                        'weight_min' => 1000,
                        'weight_max' => 10000,
                        'price' => 9.99,
                    ],
                ],
                'options' => [
                    [
                        'id' => 1,
                        'name' => 'Handtekening',
                        'tag' => 'handt',
                        'price' => '0.50',
                    ],
                    [
                        'id' => 2,
                        'name' => 'Niet bij buren',
                        'tag' => 'nbb',
                        'price' => '0.30',
                    ],
                    [
                        'id' => 3,
                        'name' => 'Rembours',
                        'tag' => 'cod',
                        'price' => '5',
                    ],
                    [
                        'id' => 13,
                        'name' => 'Avond ',
                        'tag' => 'eve',
                        'price' => '0.75',
                    ],
                    [
                        'id' => 16,
                        'name' => 'Leeftijdscheck voor ontvangst',
                        'tag' => 'age_check',
                        'price' => '1.50',
                    ],
                ],
                'combinations' => [
                    [
                        'id' => 3,
                        'name' => 'DHL Pakje',
                        'product_options' => [],
                    ],
                    [
                        'id' => 8,
                        'name' => 'DHL Pakje (handtekening)',
                        'product_options' => [
                            [
                                'id' => 1,
                                'name' => 'Handtekening',
                                'tag' => 'handt',
                            ],
                        ],
                    ],
                    [
                        'id' => 9,
                        'name' => 'DHL Pakje (niet bij buren)',
                        'product_options' => [
                            [
                                'id' => 2,
                                'name' => 'Niet bij buren',
                                'tag' => 'nbb',
                            ],
                        ],
                    ],
                    [
                        'id' => 11,
                        'name' => 'DHL Pakje (handtekening + niet bij buren)',
                        'product_options' => [
                            [
                                'id' => 1,
                                'name' => 'Handtekening',
                                'tag' => 'handt',
                            ],
                            [
                                'id' => 2,
                                'name' => 'Niet bij buren',
                                'tag' => 'nbb',
                            ],
                        ],
                    ],
                    [
                        'id' => 43,
                        'name' => 'DHL Pakje (avondlevering)',
                        'product_options' => [
                            [
                                'id' => 13,
                                'name' => 'Avond ',
                                'tag' => 'eve',
                            ],
                        ],
                    ],
                    [
                        'id' => 66,
                        'name' => 'DHL Pakje (leeftijdscheck)',
                        'product_options' => [
                            [
                                'id' => 16,
                                'name' => 'Leeftijdscheck voor ontvangst',
                                'tag' => 'age_check',
                            ],
                        ],
                    ],
                ],
            ]),
        ];
    }

    public function createShipment(string $companyId, Product $product): array
    {
        return [
            'id' => '570c6f21-55e2-43e7-a65e-bd0cf99ae868',
            'token' => 'e11da362-a00a-4fe1-adaa-e840e0fd78fd',
            'created' => '2023-08-02T10:52:39+02:00',
            'shipments' => [
                [
                    'id' => '36c403b6-0fce-45ee-bd0b-60f9f1e3aeb1',
                    'barcode' => '3SQLW1340001651',
                    'tracking_url' => 'https://goparcel.nl/track/3SQLW1340001651/NL/3353CH',
                    'shop_integration_id' => null,
                    'product' => [
                        'customs_declaration_type' => 'document',
                        'has_custom_document' => false,
                        'has_label' => true,
                        'has_zpl_label' => true,
                    ],
                    'delivery_contact' => [
                        'country' => 'NL',
                        'country_detail' => [
                            'eu_tax' => true,
                        ],
                    ],
                ],
            ],
            'labels' => [
                'a4' => [
                    'offset_0' => 'https://api.pakketdienstqls.nl/pdf/labels/570c6f21-55e2-43e7-a65e-bd0cf99ae868.pdf?token=e11da362-a00a-4fe1-adaa-e840e0fd78fd&offset=0&size=a4',
                    'offset_1' => 'https://api.pakketdienstqls.nl/pdf/labels/570c6f21-55e2-43e7-a65e-bd0cf99ae868.pdf?token=e11da362-a00a-4fe1-adaa-e840e0fd78fd&offset=1&size=a4',
                    'offset_2' => 'https://api.pakketdienstqls.nl/pdf/labels/570c6f21-55e2-43e7-a65e-bd0cf99ae868.pdf?token=e11da362-a00a-4fe1-adaa-e840e0fd78fd&offset=2&size=a4',
                    'offset_3' => 'https://api.pakketdienstqls.nl/pdf/labels/570c6f21-55e2-43e7-a65e-bd0cf99ae868.pdf?token=e11da362-a00a-4fe1-adaa-e840e0fd78fd&offset=3&size=a4',
                ],
                'a6' => 'https://api.pakketdienstqls.nl/pdf/labels/570c6f21-55e2-43e7-a65e-bd0cf99ae868.pdf?token=e11da362-a00a-4fe1-adaa-e840e0fd78fd&size=a6',
                'a6_zpl' => 'https://api.pakketdienstqls.nl/pdf/labels/570c6f21-55e2-43e7-a65e-bd0cf99ae868.zpl?token=e11da362-a00a-4fe1-adaa-e840e0fd78fd&size=a6',
            ],
        ];
    }

    public function downloadShippingLabel(string $url, string $destination): void
    {
        // TODO: Implement downloadShippingLabel() method.
    }

}
