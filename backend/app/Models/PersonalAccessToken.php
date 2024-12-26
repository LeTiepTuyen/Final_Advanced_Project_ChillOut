<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use HasUuids;

    /**
     * The data type of the primary key.
     *
     * @var string
     */
    protected $keyType = 'string'; // UUIDs are stored as strings

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false; // IDs are not auto-incrementing
}
