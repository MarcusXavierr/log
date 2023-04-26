<?php

namespace Tests\Feature\Services\Dashboard;

use App\DataTransferObjects\FilterOptionsData;
use App\Services\Dashboard\SalesDashboardService;
use App\Support\Constants\Region;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Services\Dashboard\Abstracts\DashboardTestCase;

class SalesDashboardServiceTest extends DashboardTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $now = Carbon::now();

        Carbon::setTestNow(Carbon::now()->subMonths(7));
        $this->populateDatabase(5, Region::SOUTH);

        Carbon::setTestNow($now);
        $this->populateDatabase(5, Region::NORTH);
    }

    public function test_get_sales_on_all_period()
    {
        $filter = new FilterOptionsData();
        $result = (new SalesDashboardService($filter))->getData();
        $this->assertCount(10, $result);
    }

    public function test_filter_by_date()
    {
        $filter = new FilterOptionsData(...[
            'startDate' => Carbon::now()->subYear()->format('Y-m-d'),
            'endDate' => Carbon::now()->subMonths(5)->format('Y-m-d'),
        ]);

        $result = (new SalesDashboardService($filter))->getData();
        $this->assertCount(5, $result);

    }

    public function test_filter_by_region()
    {
        $filter = new FilterOptionsData(...[
            'regions' => [Region::SOUTH, Region::MIDWEST]
        ]);

        $result = (new SalesDashboardService($filter))->getData();
        $this->assertCount(5, $result);

    }
}
