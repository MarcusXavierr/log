<?php

namespace Tests\Unit\Services;

use App\Models\Product;
use App\Services\CreateRandomProductSaleData;
use Tests\TestCase;

class CreateRandomProductSaleDataTest extends TestCase
{
    private Product $fakeProduct;
    private CreateRandomProductSaleData $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fakeProduct = $this->makeProduct(10099, 'random');
        $this->service = new CreateRandomProductSaleData();
    }

    public function test_create_random_item()
    {
        $data = $this->service->createRandomItemData($this->fakeProduct);
        $this->assertNotEquals(0, $data->units);
        $this->assertNotEquals(0, $data->pricePerUnit);
        $this->assertNotEquals(0, $data->totalPrice);
    }

    public function test_create_random_collection_of_items()
    {
        $prices = array_map(fn($index) => $index * 1000, range(1, 10));
        $products = array_map(fn($price) => $this->makeProduct($price), $prices);
        $productsCollection = collect($products);

        $result = $this->service->createRandomCollection($productsCollection);

        $this->assertCount($productsCollection->count(), $result);
        $result->each(function ($item) {
            $this->assertNotEquals(0, $item->units);
            $this->assertNotEquals(0, $item->pricePerUnit);
            $this->assertNotEquals(0, $item->totalPrice);
        });
    }

    private function makeProduct(int $price, string $name = 'whatever'): Product
    {
        $product = new Product();
        $product->name = $name;
        $product->price = $price;
        return $product;
    }
}
