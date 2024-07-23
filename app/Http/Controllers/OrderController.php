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
        //
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
        $menuItems = collect($data['menu_items']);
        $itemIds =  $menuItems->pluck('id');
        $monthCount = Order::where('created_at', Carbon::now()->month)->count();
        $validated['number'] = "KHR#" . date('y') . date('m') . str_pad($monthCount + 1, 4, "0", STR_PAD_LEFT);
        $order = Order::create($validated);
        $order->menu_items()->attach($itemIds);

        return $order->load('menu_items');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
