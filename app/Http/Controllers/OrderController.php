<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Order::with(['dining_table', 'room', 'user'])
            ->paginate(request('rowsPerPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable',
            'dining_table_id' => 'required_without:room_id',
            'room_id' => 'required_without:dining_table_id',
            'name' => 'required_without:user_id',
            'phone' => 'nullable',
        ]);
        $data = $request->validate(([
            'menu_items' => 'required|array|min:1'
        ]));
        $menuItems = $this->preProcessOrderItems($data);
        $firstOfMonth = Carbon::now()->firstOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $monthCount = Order::whereBetween('created_at', [$firstOfMonth, $endOfMonth])
            ->count();
        $validated['number'] = "KHR#" . date('y') . date('m') . str_pad($monthCount + 1, 4, "0", STR_PAD_LEFT);
        $order = Order::create($validated);
        $order->menu_items()->attach($menuItems);

        return $order->load('menu_items');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return $order->load([
            'dining_table', 'room',
            'menu_items' => fn ($menu_items) => $menu_items->select('id', 'menu_item_order.price', 'amount', 'quantity'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([

            'user_id' => 'nullable',
            'dining_table_id' => 'required_without:room_id',
            'room_id' => 'required_without:dining_table_id',
            'name' => 'required_without:user_id',
            'phone' => 'nullable',
        ]);
        $data = $request->validate(([
            'menu_items' => 'required|array|min:1'
        ]));
        $order->update($validated);
        $menuItems = $this->preProcessOrderItems($data);
        $order->menu_items()->sync($menuItems);
        return $order;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return $this->index();
    }

    public function preProcessOrderItems($data)
    {
        $menuItems = collect($data['menu_items']);

        $menuItems = $menuItems->map(function ($item) {
            $item['amount'] = $item['quantity'] * $item['price'];
            $item['menu_item_id'] = $item['id'];
            return $item;
        });
        return $menuItems->select('menu_item_id', 'price', 'quantity', 'amount');
    }
}
