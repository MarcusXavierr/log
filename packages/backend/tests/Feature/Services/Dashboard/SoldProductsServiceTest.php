<?php

namespace Tests\Feature\Services\Dashboard;

use App\DataTransferObjects\FilterOptionsData;
use App\Models\Product;
use App\Services\Dashboard\SoldProductsService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Feature\Services\Dashboard\Abstracts\DashboardTestCase;

class SoldProductsServiceTest extends DashboardTestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $now = Carbon::now();
        Carbon::setTestNow(Carbon::now()->subMonths(7));

        $this->productOne = Product::factory()->create([ 'price' => 10000, 'name' => 'test' ]);

        Carbon::setTestNow($now);
        $this->productTwo = Product::factory()->create([ 'price' => 5000, 'name' => 'product two' ]);
        $this->productThree = Product::factory()->create([ 'price' => 2500, 'name' => 'product three' ]);
    }

    public function test_list_all_products()
    {
        $this->service = new SoldProductsService(new FilterOptionsData());
        $result = $this->service->getData();

        $this->assertCount(3, $result);
        $result->each(function ($item) {
            $this->assertNotNull($item->total_revenue);
            $this->assertNotNull($item->units_sold);
        });
    }

    public function test_filter_by_name()
    {
        $filter = new FilterOptionsData(...[
            'productName' => 'product'
        ]);

        $this->service = new SoldProductsService($filter);
        $result = $this->service->getData();

        $this->assertCount(2, $result);
    }

    public function test_filter_by_price_range()
    {
        $filter = new FilterOptionsData(...[
            'minPrice' => 3000,
            'maxPrice' => 6000
        ]);

        $this->service = new SoldProductsService($filter);
        $result = $this->service->getData();

        $this->assertCount(1, $result);
        $this->assertEquals($this->productTwo->id, $result[0]->id);
    }

    public function test_filter_by_date_range()
    {
        $filter = new FilterOptionsData(...[
            'startDate' => Carbon::now()->subYear()->format('Y-m-d'),
            'endDate' => Carbon::now()->subMonths(5)->format('Y-m-d'),
        ]);

        $this->service = new SoldProductsService($filter);
        $result = $this->service->getData();

        $this->assertCount(1, $result);
        $this->assertEquals($this->productOne->id, $result[0]->id);
    }
}
