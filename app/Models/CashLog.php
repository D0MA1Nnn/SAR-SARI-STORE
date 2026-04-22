<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'log';

    protected $fillable = [
        'start_cash',
        'end_cash',
        'log_date',
    ];

    protected function casts(): array
    {
        return [
            'start_cash' => 'decimal:2',
            'end_cash' => 'decimal:2',
            'log_date' => 'date',
        ];
    }
}
