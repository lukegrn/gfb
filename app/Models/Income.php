<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    protected $fillable = [
        'name',
        'expectation'
    ];

    public function household(): BelongsTo
    {
        return $this->belongsTo(Household::class);
    }
}
