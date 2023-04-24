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
        $collection = $this->getFilteredData()->get();

        return $collection->map(function ($product) {
            return (object) [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'created_at' => $product->created_at,
                'total_revenue' => $product->productSaleItems->sum(fn ($item) => $item->total_revenue),
                'units_sold' => $product->productSaleItems->count(),
            ];
        });
    }

    public function getPaginatedData($itemsPerPage = 10): array
    {
        $collection = $this->getFilteredData()->paginate($itemsPerPage);
        $items = $collection->map(function ($product) {
            return (object) [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'created_at' => $product->created_at,
                'total_revenue' => $product->productSaleItems->sum(fn ($item) => $item->total_revenue),
                'units_sold' => $product->productSaleItems->count(),
            ];
        });

        return [
            'perPage' => $collection->perPage(),
            'currentPage' => $collection->currentPage(),
            'total' => $collection->total(),
            'items' => $items,
        ];
    }

    private function getFilteredData(): Builder
    {
        $query = Product::with('productSaleItems');

        $query = $this->filterByName($query);

        $query = $this->filterByPriceRange($query);

        return $this->filterByDateRange($query);
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
