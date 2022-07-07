<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "order";

    public function table()
    {
        return $this->hasOne(Table::class, 'id', 'fk_id_table');
    }

    public function creator()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updater()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    public function receiver()
    {
        return $this->hasOne(User::class, 'id', 'received_by');
    }

    public function deleter()
    {
        return $this->hasOne(User::class, 'id', 'deleted_by');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product',
            'fk_id_order', 'fk_id_product')
            ->withPivot('quantity', 'subtotal');
    }
}
