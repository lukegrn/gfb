<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    protected $fillable = [
        'name'
    ];

    public function lineItems(): HasMany
    {
        return $this->hasMany(LineItem::class);
    }

    public function household(): BelongsTo
    {
        return $this->belongsTo(Household::class);
    }
}
