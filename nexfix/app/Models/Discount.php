<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'code',
        'description',
        'discount_type', // 'percentage' or 'fixed'
        'value',
        'start_date',
        'end_date',
        'active',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'active' => 'boolean',
    ];

    /**
     * Quick helper: is this discount currently active & within date range?
     */
    public function getIsActiveAttribute(): bool
    {
        if (! $this->active) {
            return false;
        }

        $now = now();
        if ($this->start_date && $now->lt($this->start_date)) {
            return false;
        }
        if ($this->end_date && $now->gt($this->end_date)) {
            return false;
        }

        return true;
    }

    /**
     * Scope for active discounts
     */
    public function scopeActive($query)
    {
        return $query->where('active', true)
                     ->where('start_date', '<=', now())
                     ->where('end_date', '>=', now());
    }
}
