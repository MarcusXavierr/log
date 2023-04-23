<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\ProductSaleItem;
use App\Models\Sale;
use App\Services\CreateRandomProductSaleData;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createProductsAndSales();
    }

    private function createProductsAndSales()
    {
        $products = Product::factory(8)->create();

        $randomProductSet = create_random_subcollections($products, 3000);

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
