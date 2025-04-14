<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final readonly class HealthController
{
    #[Route('/health', methods: ['GET'])]
    public function __invoke(): Response
    {
        return new Response('👍', 200);
    }
}
