<?php

declare(strict_types=1);

namespace Test\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class HealthControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function it_should_be_healthy(): void
    {
        $client = static::createClient();

        $client->request('GET', '/health');

        $response = $client->getResponse();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('👍', $response->getContent());
    }
}
