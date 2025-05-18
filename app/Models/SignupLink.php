<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SignupLink extends Model
{
    use HasUuids;

    public function household(): BelongsTo
    {
        return $this->belongsTo(Household::class);
    }

    public function getIsExpiredAttribute()
    {
        return $this->created_at->addDays(7)->lt(Carbon::now());
    }
}
