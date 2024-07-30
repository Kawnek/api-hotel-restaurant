<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class TopSales extends Widget
{
    protected int | string | array $columnSpan = 2;

    protected static string $view = 'filament.widgets.top-sales';
    public function getStat()
    {
        return DB::table('menu_items')
            ->leftJoin('menu_item_order', 'menu_items.id', '=', 'menu_item_order.menu_item_id')
            ->leftJoin('orders', 'orders.id', '=', 'menu_item_order.order_id')
            ->select(
                'menu_items.id',
                'menu_items.name',
                DB::raw('SUM(menu_item_order.quantity) as total_quantity')
            )
            ->whereDate('orders.created_at', DB::raw('CURDATE()'))
            ->groupBy('menu_items.id', 'menu_items.name')
            ->orderBy('total_quantity', 'desc')
            ->limit(3)
            ->pluck('name')->toArray();
    }
}
