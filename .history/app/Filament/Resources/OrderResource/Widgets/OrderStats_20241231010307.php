<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $today2 = Carbon::today()->sub('1 day');
        $today3 = Carbon::today()->sub('2 day');
        $today4 = Carbon::today()->sub('3 day');
        $today5 = Carbon::today()->sub('4 day');
        $today6 = Carbon::today()->sub('5 day');
        $today7 = Carbon::today()->sub('6 day');
        // $unpaid = Number::abbreviate(Order::query()->where('branch_id', Auth::user()->branch_id)->where('is_paid', 0)->where('status', '!=', 'canceled')->sum('grand_total'), precision: 2);
        $unpaid = Number::format(Order::query()->where('branch_id', Auth::user()->branch_id)
            ->where('is_paid', 0)->where('total_cashback', '<', '0')->where('status', '!=', 'canceled')
            ->sum('total_cashback'), locale: 'de');
        $unpaid = "Rp" . $unpaid;

        // $paid = Number::abbreviate(Order::query()->where('branch_id', Auth::user()->branch_id)->where('is_paid', 1)->where('status', '!=', 'canceled')->where('created_at', '>=', Carbon::today())->sum('grand_total'), precision: 2);
        $paid = Number::format(Order::query()->where('branch_id', Auth::user()->branch_id)
            ->where('is_paid', 1)->where('status', '!=', 'canceled')->where('updated_at', '>=', Carbon::today())
            ->sum('grand_total'), locale: 'de');
        $paid = "Rp" . $paid;

        return [
            Stat::make('New Order', Order::query()->where('branch_id', Auth::user()->branch_id)->where('status', 'new')->count()),
            Stat::make('Order Processing', Order::query()->where('branch_id', Auth::user()->branch_id)->where('status', 'processing')->count()),
            Stat::make('Order Shipped', Order::query()->where('branch_id', Auth::user()->branch_id)->where('status', 'shipped')->count()),

            Stat::make('Payment Pending (All)', Order::query()->where('branch_id', Auth::user()->branch_id)->where('is_paid', 0)->count())
                ->icon('heroicon-m-bell'),
            Stat::make('Total Pending (All)', $unpaid)
                ->description('3% decrease')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('success')
                ->chart([10, 3, 15, 4, 17, 7, 2]),
            Stat::make('Total Paid Today', $paid)
                ->description('15% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info')
                ->chart([7, 2, 10, 3, 15, 4, 100]),
        ];
    }
}
