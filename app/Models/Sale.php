<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'sales';

    protected $fillable = [
        'customer_id',
        'sales_date',
    ];

    protected function casts(): array
    {
        return [
            'sales_date' => 'date',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function salesDetails(): HasMany
    {
        return $this->hasMany(SalesDetail::class, 'sales_id');
    }

    public function getTotalAmountAttribute(): float
    {
        return (float) $this->salesDetails->sum(fn (SalesDetail $detail) =>
            (float) ($detail->quantity ?? 0) * (float) ($detail->product?->price ?? 0)
        );
    }
}
