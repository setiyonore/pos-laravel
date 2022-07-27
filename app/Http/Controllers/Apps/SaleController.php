<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Transaction;

class SaleController extends Controller
{
    public function index()
    {
        return Inertia::render('Apps/Sales/Index');
    }

    public function filter(Request $request)
    {
        $this->validate($request,[
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $sales = Transaction::with('cashier','customer')
            ->whereDate('created_at','>=',$request->start_date)
            ->whereDate('created_at','<=',$request->end_date)
            ->get();

        $total = Transaction::whereDate('created_at', '>=', $request->start_date)
            ->whereDate('created_at', '<=', $request->end_date)
            ->sum('grand_total');

            return Inertia::render('Apps/Sales/Index',[
                'sales' => $sales,
                'total' => (int) $total,
            ]);
    }
}