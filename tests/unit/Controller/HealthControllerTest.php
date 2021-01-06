<?php

declare(strict_types=1);

namespace App\Tests\Unit\Controller;

use App\Controller\HealthController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

final class HealthControllerTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_return_a_successful_response(): void
    {
        $controller = new HealthController();

        $expected = new Response('👍', 200);

        self::assertEquals($expected, $controller->__invoke());
    }
}
