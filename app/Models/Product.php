<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'product';

    protected $fillable = [
        'name',
        'category_id',
        'current_price',
        'stock',
        'is_active',
        'last_cost',
        'markup_percent',
    ];

    protected function casts(): array
    {
        return [
            'current_price' => 'decimal:2',
            'stock' => 'integer',
            'is_active' => 'boolean',
            'last_cost' => 'decimal:2',
            'markup_percent' => 'decimal:2',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function salesDetails(): HasMany
    {
        return $this->hasMany(SalesDetail::class, 'product_id');
    }

    public function stockIns(): HasMany
    {
        return $this->hasMany(StockIn::class, 'product_id');
    }

    public function stockOuts(): HasMany
    {
        return $this->hasMany(StockOut::class, 'product_id');
    }

    /**
     * Calculate selling price based on last cost and markup
     */
    public function calculateSellingPrice(): float
    {
        if ($this->last_cost && $this->markup_percent) {
            return round($this->last_cost * (1 + ($this->markup_percent / 100)), 2);
        }
        return $this->current_price;
    }

    /**
     * Update product price based on new stock-in cost
     */
    public function updatePricing(float $newUnitCost): void
    {
        $this->last_cost = $newUnitCost;
        
        // Use existing markup_percent or default to 20%
        $markupPercent = $this->markup_percent ?? 20;
        
        // Recalculate current price based on new cost + markup
        $this->current_price = round($newUnitCost * (1 + ($markupPercent / 100)), 2);
        
        $this->save();
    }
}