<?php

namespace App\Services;

use App\Models\Product;
use App\DataTransferObjects\ProductSaleItemData;
use Illuminate\Support\Collection;

class CreateRandomProductSaleData
{
    public function createRandomItemData(Product $product, int $maxUnits = 10): ProductSaleItemData
    {
        $randomNumberOfUnits = rand(1, $maxUnits);

        $data = [
            'unitsSold' => $randomNumberOfUnits,
            'pricePerUnit' => $product->price,
            'totalRevenue' => $product->price * $randomNumberOfUnits,
            'productId' => $product->id
        ];

        return new ProductSaleItemData(...$data);
    }

    public function createRandomCollection(Collection $prices, $maxUnitsPerProduct = 10): Collection
    {
        return $prices->map(function ($product) use ($maxUnitsPerProduct) {
            return $this->createRandomItemData($product, $maxUnitsPerProduct);
        });
    }
}
