<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller\QLS;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CreateShipmentControllerTest extends WebTestCase
{
    /** @test */
    public function it_should_create_a_shipment(): void
    {
        $client = self::createClient();

        $client->request('POST', '/qls/shipment', [
            'product' => [
                'id' => 2,
                'name' => 'DHL Pakje',
                'type' => 'delivery',
                'servicepoint' => false,
                'max_height' => 350,
                'max_length' => 800,
                'max_width' => 500,
                'pricing' => [],
                'options' => [],
                'combinations' => [],
            ],
        ]);

        $response = $client->getResponse();

        self::assertSame(200, $response->getStatusCode());

        $content = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        self::assertSame('3SQLW1340001651', $content['shipments'][0]['barcode']);
    }
}
