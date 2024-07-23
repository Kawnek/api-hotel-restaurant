<?php

namespace Database\Seeders;

use App\Models\DiningTable;
use App\Models\Hotel;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\Room;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            // User::factory()->count(20)->create(),
        ]);
        $pivotItems = $this->generate_item_order_pivot();
        Hotel::factory()->count(3)->create();
        User::factory(10)->create();
        DiningTable::factory()->count(25)->create();
        Room::factory()->count(10)->create();
        MenuItem::factory()->count(50)->create();
        Order::factory()->count(20)->create();

        DB::table('menu_item_order')->insert($pivotItems);
    }

    public function generate_item_order_pivot()
    {
        $menuItems = [];

        for ($i = 0; $i < rand(20 * 3, 20 * 5); $i++) {
            $menuItems[] = [
                "menu_item_id" => random_int(1, 50),
                "order_id" => random_int(1, 20),
            ];
        }

        return $menuItems;
    }
}
