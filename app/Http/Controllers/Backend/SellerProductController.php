<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SellerPendingProductDataTable;
use App\DataTables\SellerProductDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerProductController extends Controller
{
    public function index(SellerProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.seller-product.index');
    }

    public function pendingProducts(SellerPendingProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.seller-pending-product.index');
    }

}