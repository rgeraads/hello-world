<?php

declare(strict_types=1);

namespace App\QLS\Order;

final class OrderLine
{
    private function __construct(
        private int $amountOrdered,
        private string $name,
        private int $sku,
        private string $ean
    ) {
    }

    public function getAmountOrdered(): int
    {
        return $this->amountOrdered;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSku(): int
    {
        return $this->sku;
    }

    public function getEan(): string
    {
        return $this->ean;
    }

    public static function fromData(array $data): self
    {
        return new self(
            $data['amount_ordered'],
            $data['name'],
            $data['sku'],
            $data['ean']
        );
    }
}
