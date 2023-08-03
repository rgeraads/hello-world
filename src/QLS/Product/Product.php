<?php

declare(strict_types=1);

namespace App\QLS\Product;

final readonly class Product
{
    /**
     * @param array{mixed} $pricing
     * @param array{mixed} $options
     * @param array{mixed} $combinations
     */
    private function __construct(
        private int $id,
        private string $name,
        private string $type,
        private bool $servicepoint,
        private ?int $maxHeight,
        private ?int $maxLength,
        private ?int $maxWidth,
        private array $pricing,
        private array $options,
        private array $combinations
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCombinations(): array
    {
        return $this->combinations;
    }

    /**
     * @return array{string, string}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'servicepoint' => $this->servicepoint,
            'max_height' => $this->maxHeight,
            'max_length' => $this->maxLength,
            'max_width' => $this->maxWidth,
            'pricing' => $this->pricing,
            'options' => $this->options,
            'combinations' => $this->combinations,
        ];
    }

    public static function fromData(array $data): self
    {
        return new self(
            (int)$data['id'],
            $data['name'],
            $data['type'],
            (bool)$data['servicepoint'],
            $data['max_height'] ? (int)$data['max_height'] : null,
            $data['max_length'] ? (int)$data['max_length'] : null,
            $data['max_width'] ? (int)$data['max_width'] : null,
            $data['pricing'],
            $data['options'],
            $data['combinations']
        );
    }
}
