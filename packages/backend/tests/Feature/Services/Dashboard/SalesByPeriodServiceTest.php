<?php

namespace Tests\Feature\Services\Dashboard;

use App\DataTransferObjects\FilterOptionsData;
use App\Services\Dashboard\SalesByPeriodService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\Services\Dashboard\Abstracts\DashboardTestCase;

class SalesByPeriodServiceTest extends DashboardTestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        $now = Carbon::now();

        Carbon::setTestNow(Carbon::now()->subMonths(7));
        $this->populateDatabase(4, 5);

        Carbon::setTestNow($now);
        $this->populateDatabase(4, 5);

        $this->service = new SalesByPeriodService();
    }

    public function test_get_sales_on_all_period()
    {
        $filter = new FilterOptionsData();
        $result = $this->service->getData($filter);
        $this->assertCount(10, $result);
    }

    public function test_filter_by_date()
    {
        $filter = new FilterOptionsData(...[
            'startDate' => Carbon::now()->subYear()->format('Y-m-d'),
            'endDate' => Carbon::now()->subMonths(5)->format('Y-m-d'),
        ]);

        $result = $this->service->getData($filter);
        $this->assertCount(5, $result);

    }
}
