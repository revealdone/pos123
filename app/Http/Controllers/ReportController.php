<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::query();

        if ($request->start_date && $request->end_date) {

            $query->whereBetween('transaction_date', [
                $request->start_date,
                $request->end_date
            ]);
        }

        return Inertia::render('Reports/Index', [
            'transactions' => $query->latest()->get()
        ]);
    }
}
