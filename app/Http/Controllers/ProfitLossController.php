<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Models\Payment;
use App\Models\AccountBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Carbon\Carbon;

class ProfitLossController extends Controller
{
    /* ======================
     |  INDEX
     ====================== */
    public function index(Request $request)
    {
        // =======================
        // SMART DATE DEFAULT
        // =======================
        $isFirstLoad = $request->query->count() === 0;

        $startDate = $request->get('date_from');
        $endDate   = $request->get('date_to');

        if ($isFirstLoad) {
            $startDate = Carbon::now()->startOfMonth()->toDateString();
            $endDate   = Carbon::now()->endOfMonth()->toDateString();
        }

        // =======================
        // BASE QUERY
        // =======================
        $baseQuery = Payment::query()
            ->where('branch_id', Auth::user()->branch_id) // pastikan filter branch tetap berlaku
            ->where('mutation_type', '!=', 'Kembalian')
            ->where(function ($q) {
                $q->where('debit_akun', 'LIKE', '%LR-%')
                ->orWhere('kredit_akun', 'LIKE', '%LR-%');
            })
            ->with([
                'branch:id,name',
                'user:id,name',
                'userCre:id,name',
                'userUpd:id,name',
                'paymentable:id',
                'journal:id,code,description',
            ])
            ->when($startDate, fn ($q) => $q->whereDate('date', '>=', $startDate))
            ->when($endDate, fn ($q) => $q->whereDate('date', '<=', $endDate));

        // =======================
        // ORDER BY
        // =======================
        $allowedColumns = ['date', 'mutation_type', 'created_at', 'updated_at'];
        $orderBy  = $request->input('order_by', 'date');
        $orderDir = $request->input('order_dir', 'desc');

        if (!in_array($orderBy, $allowedColumns)) $orderBy = 'date';
        if (!in_array($orderDir, ['asc','desc'])) $orderDir = 'desc';

        $baseQuery->orderBy($orderBy, $orderDir);

        // =======================
        // SUMMARY (total_nominal)
        // =======================
        $summary = [
            'total_nominal' => 
                (clone $baseQuery)->where('kredit_akun', 'LIKE', '%LR-%')->sum('nominal')
            - (clone $baseQuery)->where('debit_akun', 'LIKE', '%LR-%')->sum('nominal'),
        ];

        // =======================
        // PAGINATION
        // =======================
        $payments = $baseQuery
            ->paginate(100)
            ->through(function ($payment) {
                // URL untuk frontend
                $payment->paymentable_url = match ($payment->paymentable_type) {
                    \App\Models\Order::class => route('penjualan.show', $payment->paymentable_id),
                    \App\Models\PurchaseOrder::class => route('pembelian.show', $payment->paymentable_id),
                    \App\Models\AdjustmentStock::class => route('penyesuaian-stok.edit', $payment->paymentable_id),
                    \App\Models\Journal::class => route('jurnal.edit', $payment->paymentable_id),
                    default => null,
                };
                // pastikan code ada untuk semua paymentable
                $payment->code = $payment->paymentable?->code ?? '-';
                return $payment;
            })
            ->withQueryString();

        // =======================
        // ACCOUNT BALANCE
        // =======================
        $accountBalance = AccountBalance::where('branch_id', Auth::user()->branch_id)
            ->select('akun')
            ->orderBy('akun')
            ->get();

            // dd($payments->toArray());
        // =======================
        // RENDER
        // =======================
        return Inertia::render('ProfitLoss/Index', [
            'payments' => $payments,
            'summary' => $summary,
            'accountBalance' => $accountBalance,
            'filters' => [
                'date_from' => $startDate,
                'date_to'   => $endDate,
                'order_by' => $orderBy,
                'order_dir' => $orderDir,
            ],
        ]);
    }



    

}
