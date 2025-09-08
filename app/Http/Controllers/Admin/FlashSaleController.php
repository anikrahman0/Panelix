<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\FlashSaleCrudService;
use App\Http\Requests\FlashSaleValidationRequest;

class FlashSaleController extends Controller
{
    public function index()
    {
        $falshSales = FlashSaleCrudService::listFlashSales();
        return view('layouts.admin.dashboard.flash-sale.index', $falshSales);
    }

    public function create()
    {
        $data = FlashSaleCrudService::createFlashSale();
        return view('layouts.admin.dashboard.flash-sale.add', $data);
    }

    public function store(FlashSaleValidationRequest $request)
    {
        $data = FlashSaleCrudService::storeFlashSale($request);
        return to_route('admin.flash-sale.index')->with('success', $data['message']);
    }

    public function edit($id)
    {
        $flashSale = FlashSaleCrudService::editFlashSale($id);
        return view('layouts.admin.dashboard.flash-sale.edit', $flashSale);
    }

    public function update(FlashSaleValidationRequest $request, $id)
    {
        $data = FlashSaleCrudService::updateFlashSale($request, $id);
        return to_route('admin.flash-sale.index')->with('success', $data['message']);
    }

    public function destroy(string $id)
    {
        $data = FlashSaleCrudService::deleteFlashSale($id);
        return back()->with('success', $data['message']);
    }
}
