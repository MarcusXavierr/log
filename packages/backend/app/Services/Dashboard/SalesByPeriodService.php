<?php

namespace App\Services\Dashboard;

use App\DataTransferObjects\FilterOptionsData;
use App\Models\Sale;
use Illuminate\Support\Collection;

class SalesByPeriodService
{
    public function getData(FilterOptionsData $filter): Collection
    {
        return Sale::where($this->getFilters($filter))->get();
    }

    private function getFilters(FilterOptionsData $filter): array
    {
        if (! $filter->endDate || ! $filter->startDate) {
            return [];
        }

        return [
            [ 'created_at', '>=', $filter->startDate ],
            [ 'created_at', '<', $filter->endDate ]
        ];
    }
}
