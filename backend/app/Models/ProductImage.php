<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = true;
    
    protected $fillable = [
        'product_id',
        'url',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id')
            ->onDelete('cascade');
    }
}
