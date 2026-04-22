<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'customer';

    protected $fillable = [
        'customer_name',
        'contact_number',
        'collateral_type_id',
    ];

    public function collateralType(): BelongsTo
    {
        return $this->belongsTo(CollateralType::class, 'collateral_type_id');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'customer_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'customer_id');
    }

    public function blockLists(): HasMany
    {
        return $this->hasMany(BlockList::class, 'customer_id');
    }
}
