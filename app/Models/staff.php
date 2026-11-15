<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class staff extends Model
{
    protected $table = 'staff';

    protected $fillable = [
        'name',
        'gender',
        'phone',
        'salary',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
