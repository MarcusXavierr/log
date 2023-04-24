<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataFilterRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(DataFilterRequest $request)
    {
        dd($request->all(), $request->validated());
    }
}
