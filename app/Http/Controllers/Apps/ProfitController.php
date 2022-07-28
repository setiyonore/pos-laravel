<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ProfitsExport;
use App\Models\Profit;

class ProfitController extends Controller
{
    public function index()
    {
        return Inertia::render('Apps/Profits/Index');
    }

    public function filter(Request $request)
    {
        $this->validate($request,[
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        //get data profits by range date
        $profits = Profit::with('transaction')->whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->get();

        //get total profit by range date
        $total = Profit::whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->sum('total');

        return Inertia::render('Apps/Profits/Index',[
            'profits' => $profits,
            'total' => (int) $total,
        ]);
    }

    public function export(Request $request)
    {
        return Excel::download(new ProfitsExport($request->start_date, $request->end_date), 'profits : '.$request->start_date.' — '.$request->end_date.'.xlsx');
    }

    public function pdf(Request $request) {
        $profits = Profit::with('transaction')->whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->get();
        $total = Profit::whereDate('created_at', '>=', $request->start_date)->whereDate('created_at', '<=', $request->end_date)->sum('total');
        $pdf = PDF::loadView('exports.profits', compact('profits', 'total'));
        return $pdf->download('profits : '.$request->start_date.' — '.$request->end_date.'.pdf');
    }
}
