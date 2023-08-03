<?php

declare(strict_types=1);

namespace App\Tests\Unit\SLQ\Product;

use App\QLS\Product\Product;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    /** @test */
    public function it_should_construct_from_and_to_array(): void
    {
        $data = self::getProductData();

        $product = Product::fromData($data);

        self::assertSame($data, $product->toArray());
    }

    /** @test */
    public function it_should_expose_its_id(): void
    {
        $data = self::getProductData();

        $product = Product::fromData($data);

        self::assertSame(2, $product->getId());
    }

    /** @test */
    public function it_should_expose_its_name(): void
    {
        $data = self::getProductData();

        $product = Product::fromData($data);

        self::assertSame('DHL Pakje', $product->getName());
    }

    /** @test */
    public function it_should_expose_its_combinations(): void
    {
        $data = self::getProductData();

        $product = Product::fromData($data);

        $expected = [
            [
                'id' => 3,
                'name' => 'DHL Pakje',
                'product_options' => [],
            ],
        ];

        self::assertSame($expected, $product->getCombinations());
    }

    private static function getProductData(): array
    {
        return [
            'id' => 2,
            'name' => 'DHL Pakje',
            'type' => 'delivery',
            'servicepoint' => false,
            'max_height' => 350,
            'max_length' => 800,
            'max_width' => 500,
            'pricing' => [
                [
                    'id' => 3,
                    'country' => 'NL',
                    'weight_min' => 0,
                    'weight_max' => 1000,
                    'price' => 9.99,
                ],
            ],
            'options' => [
                [
                    'id' => 1,
                    'name' => 'Handtekening',
                    'tag' => 'handt',
                    'price' => '0.50',
                ],
            ],
            'combinations' => [
                [
                    'id' => 3,
                    'name' => 'DHL Pakje',
                    'product_options' => [],
                ],
            ],
        ];
    }
}
