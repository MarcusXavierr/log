<?php

namespace Tests\Feature\Services\Dashboard\Abstracts;

use App\Models\Product;
use App\Models\ProductSaleItem;
use App\Models\Sale;
use App\Services\CreateRandomProductSaleData;
use Carbon\Carbon;
use Tests\TestCase;

abstract class DashboardTestCase extends TestCase
{
    protected $service;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function populateDatabase($numberOfProducts = 8, $numberOfSales = 10)
    {
        $products = Product::factory($numberOfProducts)->create();

        $randomProductSet = create_random_subcollections($products, $numberOfSales);

        $randomProductSet->each(function ($products) {
            $data = (new CreateRandomProductSaleData())->createRandomCollection($products);

            $sale = Sale::factory()->create([
                'value' => $data->sum(fn($item) => $item->totalRevenue),
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
