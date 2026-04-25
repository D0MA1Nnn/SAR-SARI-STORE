<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'supplier';

    protected $fillable = [
        'supplier_name',
        'contact_number',
        'address',
        'email',
        'contact_person',
    ];

    public function stockIns(): HasMany
    {
        return $this->hasMany(StockIn::class, 'supplier_id');
    }
}