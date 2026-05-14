<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Models\TransactionDetail;

class DashboardController extends Controller
{


    public function index()
    {
        $totalProducts = Product::count();

        $totalTransactions = Transaction::count();

        $totalRevenue = (float) Transaction::sum('total_price');

        $totalProfit = (float) Product::sum(
    DB::raw('(selling_price - purchase_price) * stock')  
);
        $totalAsset = (float) Product::sum(
    DB::raw('purchase_price * stock')
);
$netProfit = (float) TransactionDetail::join(
    'products',
    'transaction_details.product_id',
    '=',
    'products.id'
)->sum(
    DB::raw(
        '(transaction_details.price - products.purchase_price)
        * transaction_details.quantity'
    )
);

        $lowStockProducts = Product::where('stock', '<', 10)->get();

        return Inertia::render('Dashboard', [
            'totalProducts' => $totalProducts,
            'totalTransactions' => $totalTransactions,
            'totalRevenue' => $totalRevenue,
            'lowStockProducts' => $lowStockProducts,
            'totalProfit' => $totalProfit,
            'totalAsset' => $totalAsset,
            'netProfit' => $netProfit,
        ]);
        
    }
    
}
