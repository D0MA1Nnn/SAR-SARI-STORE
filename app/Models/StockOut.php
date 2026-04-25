<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockOut extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'stock_out';

    protected $fillable = [
        'product_id',
        'quantity',
        'reason',
        'stock_date',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'stock_date' => 'datetime',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
