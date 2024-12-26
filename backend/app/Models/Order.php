<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $keyType = 'string'; // Đảm bảo kiểu string cho UUID
    public $incrementing = false; // Vô hiệu hóa tự động tăng

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'zipcode',
        'city',
        'country',
        'created_at',
    ];

    /**
     * Boot method to set default UUID for id.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Sinh UUID cho cột id nếu chưa có
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    /**
     * Relationship: Order has many OrderItems.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
