<?php

namespace App\DataTransferObjects;

use App\Traits\ReadableProtectedAttribute;

class ProductSaleItemData
{
    use ReadableProtectedAttribute;

    public function __construct(
        protected int $units = 0,
        protected int $pricePerUnit = 0,
        protected int $totalPrice = 0
    ) {}
}
