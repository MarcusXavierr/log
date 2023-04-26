<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\FilterOptionsData;
use App\Http\Requests\DataFilterRequest;
use App\Services\Dashboard\SalesDashboardService;
use App\Services\Dashboard\SoldProductsService;
use Exception;

class DashboardController extends Controller
{
    public function index(DataFilterRequest $request)
    {
        try {
            $data = $request->validated();
            $filter = new FilterOptionsData(...$data);

            return response()->json([
                // 'sales_data' => (new SalesDashboardService($filter))->getData(),
                'products_data' => (new SoldProductsService($filter))->getData()
            ]);
        } catch(Exception $e) {
            report($e);
            abort(500, 'Could not get data, try again later');
        }
    }
}
