<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchases extends Model
{
    protected $fillable = [
        'supplier_id',
        'purchase_date',
        'total_amount',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

    public function purchaseDetails(): HasMany
    {
        return $this->hasMany(PurchasesDetail::class, 'purchase_id');
    }
}
