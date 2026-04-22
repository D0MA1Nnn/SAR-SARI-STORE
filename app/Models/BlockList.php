<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class BlockList extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'block_list';

    protected $fillable = [
        'customer_id',
        'violation_id',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function violation(): BelongsTo
    {
        return $this->belongsTo(Violation::class, 'violation_id');
    }
}
