<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Builder
 */
class AccessType extends Model
{
    use HasFactory;

    public $primaryKey = 'code';

    public $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
        'display_order',
    ];

    /**
     * Discount relationship
     *
     * @return HasMany
     */
    public function discount(): HasMany
    {
        return $this->hasMany(Discount::class);
    }
}
