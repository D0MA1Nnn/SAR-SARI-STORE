<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockIn extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'stock_in';

    protected $fillable = [
        'product_id',
        'quantity',
        'unit_cost',
        'supplier_id',
        'stock_date',
        'reference',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'stock_date' => 'datetime',
            'unit_cost' => 'decimal:2',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
