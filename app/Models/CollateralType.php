<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class CollateralType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'collateral_type';

    protected $fillable = [
        'description',
    ];

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'collateral_type_id');
    }
}
