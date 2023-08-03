<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller\QLS;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class GetProductsControllerTest extends WebTestCase
{
    /** @test */
    public function it_should_retrieve_a_list_of_products(): void
    {
        $client = self::createClient();

        $client->request('GET', '/qls/products');

        $response = $client->getResponse();

        self::assertSame(200, $response->getStatusCode());

        $product = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR)[0];
        self::assertSame(2, $product['id']);
        self::assertSame('DHL Pakje', $product['name']);
    }
}
