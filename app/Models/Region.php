<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 */
class Region extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'display_order',
    ];

    /**
     * Discount relationship
     * @return HasMany
     */
    public function discounts(): HasMany
    {
        return $this->hasMany(Discount::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order_by_display_order', function (Builder $builder) {
            $builder->orderBy('display_order');
        });
    }
}
