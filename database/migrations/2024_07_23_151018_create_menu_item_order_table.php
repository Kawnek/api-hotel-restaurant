<?php

use App\Models\MenuItem;
use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_item_order', function (Blueprint $table) {
            $table->foreignIdFor(MenuItem::class);
            $table->foreignIdFor(Order::class);
            $table->decimal('quantity')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('amount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_item_order');
    }
};
