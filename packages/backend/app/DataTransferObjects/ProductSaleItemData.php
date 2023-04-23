<?php

namespace App\DataTransferObjects;

use App\Traits\ReadableProtectedAttribute;

class ProductSaleItemData
{
    use ReadableProtectedAttribute;

    public function __construct(
        protected int   $unitsSold = 0,
        protected int   $pricePerUnit = 0,
        protected int   $totalRevenue = 0,
        protected mixed $productId = 0
    ) {}
}
