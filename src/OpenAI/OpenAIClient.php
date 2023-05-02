<?php

declare(strict_types=1);

namespace App\OpenAI;

interface OpenAIClient
{
    public function setResponder(?Responder $responder): void;
    public function setLanguage(?Language $language): void;
    public function ask(string $prompt): string;
}
