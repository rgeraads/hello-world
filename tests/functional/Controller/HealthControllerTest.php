<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class HealthControllerTest extends WebTestCase
{
    #[Test]
    public function it_should_be_healthy(): void
    {
        $client = self::createClient();

        $client->request('GET', '/health');

        $response = $client->getResponse();

        self::assertSame(200, $response->getStatusCode());
        self::assertSame('👍', $response->getContent());
    }
}
