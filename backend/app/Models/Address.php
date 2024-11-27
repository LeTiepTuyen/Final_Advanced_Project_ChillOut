<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $incrementing = true;
    
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'zipcode',
        'city',
        'country',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
