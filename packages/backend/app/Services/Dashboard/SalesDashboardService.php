<?php

namespace App\Services\Dashboard;

use App\DataTransferObjects\FilterOptionsData;
use App\Models\Sale;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class SalesDashboardService
{
    private readonly FilterOptionsData $filter;

    public function __construct(FilterOptionsData $filter)
    {
        $this->filter = $filter;
    }

    public function getData(): Collection
    {
        return $this->getFilteredData()->get();
    }

    public function getPaginatedData($itemsPerPage): LengthAwarePaginator
    {
        return $this->getFilteredData()->paginate($itemsPerPage);
    }

    private function getFilteredData(): Builder
    {
        $query = Sale::select(['id', 'value', 'region', 'created_at']);

        $query = $this->filterByDateRange($query);

        return $this->filterByRegion($query);
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

    private function filterByRegion(Builder $query): Builder
    {
        if (! $this->filter->regions) {
            return $query;
        }

        return $query->whereIn('region', $this->filter->regions);
    }
}
