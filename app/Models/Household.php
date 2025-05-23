<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Household extends Model
{
    protected $fillable = [
        'name'
    ];

    public function plans(): HasMany
    {
        return $this->hasMany(Plan::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function signupLinks(): HasMany
    {
        return $this->hasMany(SignupLink::class);
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class);
    }
}
