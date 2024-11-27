<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = true;
    
    protected $fillable = [
        'order_id',
        'product_id',
        'created_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id')
            ->onDelete('cascade');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
