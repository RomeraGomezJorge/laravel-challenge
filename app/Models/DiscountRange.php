<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Builder
 */
class DiscountRange extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_days',
        'to_days',
        'code',
        'discount',
        'discount_id',
    ];

    /**
     * Discount relationship
     * @return BelongsTo
     */
    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }
}
