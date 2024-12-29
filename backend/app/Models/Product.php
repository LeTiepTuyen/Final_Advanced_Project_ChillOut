<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Product extends Model
{
    use HasFactory;
    use Searchable;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = true;

    protected $fillable = [
        'title',
        'description',
        'short_description',
        'url',
        'price',
        'created_at',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'id');
    }

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'short_description' => $this->short_description,
        ];
    }

    public function searchableAs(): string
    {
        return 'products';
    }
}
