<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @mixin Builder
 */
class Discount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'active',
        'start_date',
        'end_date',
        'priority',
        'active',
        'region_id',
        'brand_id',
        'access_type_code',
    ];

    /**
     * Region relationship
     * @return BelongsTo
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Brand relationship
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Access type relationship
     * @return BelongsTo
     */
    public function access_type(): BelongsTo
    {
        return $this->belongsTo(AccessType::class);
    }

    /**
     * Discount range relationship
     * @return HasMany
     */
    public function discount_range(): HasMany
    {
        return $this->hasMany(DiscountRange::class);
    }

    /**
     * Return start and end date combined
     *
     * @return string
     */
    public function getPeriodAttribute(): string
    {
        return Carbon::parse($this->attributes['start_date'])->format('d M. Y') . ' / ' . Carbon::parse($this->attributes['end_date'])->format('d M. Y');
    }

    /**
     * Change format from back-end to front-end compatible
     *
     * @return string
     */
    public function getStartDateFormated(): string
    {
        return Carbon::parse($this->attributes['start_date'])->format('Y-m-d');
    }

    /**
     * Change format from back-end to front-end compatible
     *
     * @return string
     */
    public function getEndDateFormated(): string
    {
        return Carbon::parse($this->attributes['end_date'])->format('Y-m-d');
    }
}
