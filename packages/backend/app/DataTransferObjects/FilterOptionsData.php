<?php

namespace App\DataTransferObjects;

use App\Traits\ReadableProtectedAttribute;
use Carbon\Carbon;

class FilterOptionsData
{
    use ReadableProtectedAttribute;

    public function __construct(
        protected $productName = null,
        protected $region = null,
        protected $startDate = null,
        protected $endDate = null,
        protected $minPrice = null,
        protected $maxPrice = null
    ) {
        if (! is_null($this->startDate)) {
            $this->startDate = Carbon::create($this->startDate)->startOfDay();
        }

        if (! is_null($this->endDate)) {
            $this->endDate = Carbon::create($this->endDate)->endOfDay();
        }
    }
}
