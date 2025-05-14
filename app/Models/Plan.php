<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
