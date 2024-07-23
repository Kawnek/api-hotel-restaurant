<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function dining_table()
    {
        return $this->belongsTo(DiningTable::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function menu_items()
    {
        return $this->belongsToMany(MenuItem::class);
    }
}
