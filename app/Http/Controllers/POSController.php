<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\StockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class POSController extends Controller
{
    public function index()
    {
        return Inertia::render('POS/Index', [
            'products' => Product::all()
        ]);
    }

    public function checkout(Request $request)
    {
        DB::beginTransaction();

        try {

            $transaction = Transaction::create([
                'invoice_number' => 'INV-' . time(),
                'user_id' => Auth::id(),
                'total_price' => $request->total_price,
                'paid_amount' => $request->paid_amount,
                'change_amount' => $request->change_amount,
                'transaction_date' => now(),
            ]);

            foreach ($request->items as $item) {

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price' => $item['selling_price'],
                    'subtotal' => $item['selling_price'] * $item['qty'],
                ]);

                $product = Product::find($item['id']);

                if ($product->stock < $item['qty']) {

    return back()->withErrors([
        'message' => $product->name . ' stock tidak cukup'
    ]);
}

                $product->decrement('stock', $item['qty']);

                StockLog::create([
                    'product_id' => $item['id'],
                    'type' => 'out',
                    'quantity' => $item['qty'],
                    'description' => 'Penjualan barang'
                ]);
            }

            DB::commit();

return response()->json([
    'success' => true,
    'message' => 'Pembayaran berhasil',
    'print_url' => route(
        'transactions.print',
        $transaction->id
    )
]);

        } catch (\Exception $e) {

            DB::rollback();

            return back()->withErrors([
                'message' => $e->getMessage()
            ]);
        }
    }
}
