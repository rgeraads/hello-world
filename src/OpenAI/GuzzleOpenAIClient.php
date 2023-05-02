<?php

declare(strict_types=1);

namespace App\OpenAI;

use GuzzleHttp\Client;

final class GuzzleOpenAIClient implements OpenAIClient
{
    private const URL = 'https://api.openai.com/v1/chat/completions';
    private ?Responder $responder = null;
    private ?Language $language = null;

    public function __construct(private readonly Client $client, private readonly string $openaiApiKey)
    {
    }

    public function setResponder(?Responder $responder): void
    {
        if ($responder === null) {
            return;
        }

        $this->responder = $responder;
    }

    public function setLanguage(?Language $language): void
    {
        if ($language === null) {
            return;
        }

        $this->language = $language;
    }

    public function ask(string $prompt): string
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->openaiApiKey,
            'Accept' => 'application/json'
        ];


        $params = [
            'messages' => [],
            'model' => 'gpt-3.5-turbo',
            'temperature' => 0,
        ];

        if ($this->responder) {
            $params['messages'][] = ['role' => 'system', 'content' => sprintf('Pretend you are the following person: %s', $this->reponder->value)];
        }

        if ($this->language) {
            $params['messages'][] = ['role' => 'system', 'content' => sprintf('Answer in the following language: %s', $this->language->value)];
        }

        $params['messages'][] = ['role' => 'user', 'content' => $prompt];

        $response = $this->client->post(self::URL, [
            'headers' => $headers,
            'json' => $params
        ]);

        $contents = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        return $contents['choices'][0]['message']['content'];
    }
}
