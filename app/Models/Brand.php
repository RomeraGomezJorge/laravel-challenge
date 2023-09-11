<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class Brand extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'display_order',
        'active',
    ];

    public function scopeActive($query)
    {
        return $query->whereActive(1);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order_by_display_order', function (Builder $builder) {
            $builder->orderBy('display_order');
        });
    }
}
