<?php

declare(strict_types=1);

namespace App\QLS\Order;

final class Order
{
    private function __construct(
        private string $orderNumber,
        private BillingAddress $billingAddress,
        private DeliveryAddress $deliveryAddress,
        private array $orderLines
    ) {
    }

    public function getOrderNumber(): string
    {
        return $this->orderNumber;
    }

    public function getBillingAddress(): BillingAddress
    {
        return $this->billingAddress;
    }

    public function getDeliveryAddress(): DeliveryAddress
    {
        return $this->deliveryAddress;
    }

    /**
     * @return OrderLine[]
     */
    public function getOrderLines(): array
    {
        return $this->orderLines;
    }

    public static function fromData(array $data): self
    {
        return new self(
            $data['number'],
            BillingAddress::fromData($data['billing_address']),
            DeliveryAddress::fromData($data['delivery_address']),
            array_map(fn ($orderLine) => OrderLine::fromData($orderLine), $data['order_lines'])
        );
    }
}
