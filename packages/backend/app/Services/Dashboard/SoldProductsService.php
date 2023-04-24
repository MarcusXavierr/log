<?php

namespace App\Services\Dashboard;

use App\DataTransferObjects\FilterOptionsData;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class SoldProductsService
{
    private FilterOptionsData $filter;

    public function __construct(FilterOptionsData $filter)
    {
       $this->filter = $filter;
    }

    public function getData(): Collection
    {
        $query = Product::with('productSaleItems:id,units_sold,total_revenue');

        $query = $this->filterByName($query);

        $query = $this->filterByPriceRange($query);

        return $this->filterByDateRange($query)->get();
    }

    private function filterByName(Builder $query): Builder
    {
        if (! $this->filter->productName) {
            return $query;
        }

        return $query->where('name', 'LIKE', $this->filter->productName . '%');
    }

    private function filterByPriceRange(Builder $query): Builder
    {
        if (! $this->filter->minPrice || ! $this->filter->maxPrice) {
            return $query;
        }

        return $query->where([
            [ 'price', '>=', $this->filter->minPrice ],
            [ 'price', '<', $this->filter->maxPrice ],
        ]);
    }

    private function filterByDateRange(Builder $query): Builder
    {
        if (! $this->filter->endDate || ! $this->filter->startDate) {
            return $query;
        }

        return $query->where([
            [ 'created_at', '>=', $this->filter->startDate ],
            [ 'created_at', '<', $this->filter->endDate ]
        ]);
    }
}
