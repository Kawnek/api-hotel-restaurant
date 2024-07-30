<?php

namespace App\Filament\Widgets;

use App\Models\MenuItem;
use App\Models\Order;
use Carbon\Carbon;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{

    protected function getStats(): array
    {

        $orders = DB::table('orders')
            ->leftJoin('menu_item_order', 'orders.id', '=', 'menu_item_order.order_id')
            ->leftJoin('menu_items', 'menu_item_order.menu_item_id', '=', 'menu_items.id')
            ->select(
                'orders.id',
                DB::raw('SUM(menu_item_order.amount) as total_amount')
            )
            ->whereDate('orders.created_at', DB::raw('CURDATE()'))
            ->groupBy('orders.id')
            ->get();


        $totalAmount = $orders->sum('total_amount');

        return [
            Stat::make('Total orders today', $orders->count()),
            Stat::make('Total amount', "₹ $totalAmount"),
        ];
    }
}
