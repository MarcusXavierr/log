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
        $this->create();
    }


    private function create()
    {
        $products = Product::factory(10)->create();
        $data = (new CreateRandomProductSaleData())->createRandomCollection($products);

        $sale = Sale::factory()->create([
            'value' => $data->sum(fn($item) => $item->totalPrice)
        ]);
        $data->each(function($dto) use($sale) {
            ProductSaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $dto->productId,
                'price_per_unit' => $dto->pricePerUnit,
                'total_revenue' => $dto->totalPrice,
                'units_sold' => $dto->units
            ]);
        });

    }
}
