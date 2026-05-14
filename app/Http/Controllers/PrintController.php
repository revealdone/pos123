<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{
        public function printReceipt($id)
    {
        $transaction = Transaction::with(
            'details.product',
            'user'
        )->findOrFail($id);

        return view('print.receipt', compact('transaction'));
    }

    public function exportPDF()
    {
        $transactions = Transaction::latest()->get();

        $pdf = Pdf::loadView('print.report', compact('transactions'));

        return $pdf->download('sales-report.pdf');
    }
}
