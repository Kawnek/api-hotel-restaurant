<?php

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('redirect-login', function () {
    return redirect('login');
})->name('login');
Route::get('asdf', function () {
    $menuItems = DB::table('menu_items')
        ->leftJoin('menu_item_order', 'menu_items.id', '=', 'menu_item_order.menu_item_id')
        ->leftJoin('orders', 'orders.id', '=', 'menu_item_order.order_id')
        ->select(
            'menu_items.id',
            'menu_items.name',
            DB::raw('SUM(menu_item_order.quantity) as total_quantity')
        )
        ->whereDate('orders.created_at', DB::raw('CURDATE()'))
        ->groupBy('menu_items.id', 'menu_items.name');
    $data = $menuItems
        ->orderBy('total_quantity', 'desc')
        ->limit(3)
        // ->get()
        ->pluck('name')
        //
    ;

    return implode(' | ', $data->toArray());
});

function orderStat()
{
    $result = DB::table('orders')
        ->leftJoin('menu_item_order', 'orders.id', '=', 'menu_item_order.order_id')
        ->leftJoin('menu_items', 'menu_item_order.menu_item_id', '=', 'menu_items.id')
        ->select(
            'orders.id',
            // 'orders.number',
            // 'orders.name',
            // DB::raw('COUNT(DISTINCT orders.id) as order_count'),
            DB::raw('SUM(menu_item_order.amount) as total_amount')
            // DB::raw('SUM(menu_items.price * menu_item_order.quantity) as total_amount')

        )
        ->whereDate('orders.created_at', DB::raw('CURDATE()'))
        ->groupBy('orders.id')
        ->get();
    return $result->sum('total_amount');
}
