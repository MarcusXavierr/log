<?php

namespace Tests\Feature\Services\Dashboard\Abstracts;

use App\Models\Product;
use App\Models\ProductSaleItem;
use App\Models\Sale;
use App\Services\CreateRandomProductSaleData;
use App\Support\Constants\Region;
use Tests\TestCase;

abstract class DashboardTestCase extends TestCase
{
    protected $service;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function populateDatabase($numberOfSales = 10, $region = Region::NORTH)
    {
        $products = Product::factory(5)->create();

        $randomProductSet = create_random_subcollections($products, $numberOfSales);

        $randomProductSet->each(function ($products) use ($region) {
            $data = (new CreateRandomProductSaleData())->createRandomCollection($products);

            $sale = Sale::factory()->create([
                'value' => $data->sum(fn($item) => $item->totalRevenue),
                'region' => $region
            ]);

            $data->each(function ($dto) use ($sale) {
                ProductSaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $dto->productId,
                    'price_per_unit' => $dto->pricePerUnit,
                    'total_revenue' => $dto->totalRevenue,
                    'units_sold' => $dto->unitsSold,
                ]);
            });
        });
    }
}
