<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\FilterOptionsData;
use App\Http\Requests\DataFilterRequest;
use App\Services\Dashboard\SalesDashboardService;
use App\Services\Dashboard\SoldProductsService;
use Exception;

class DetailController extends Controller
{
    public function detailProducts(DataFilterRequest $request)
    {
        try {
            $data = $request->validated();
            $filter = new FilterOptionsData($data);

            return response()->json([
                'data' => (new SoldProductsService($filter))->getPaginatedData()
            ]);
        } catch (Exception $e) {
            report($e);
            abort(500, 'Could not get detailment of products, try again later');
        }
    }

    public function detailSales(DataFilterRequest $request)
    {
        try {
            $data = $request->validated();
            $filter = new FilterOptionsData($data);

            return response()->json([
                'data' => (new SalesDashboardService($filter))->getPaginatedData()
            ]);
        } catch (Exception $e) {
            report($e);
            abort(500, 'Could not get detailment of products, try again later');
        }
    }
}
