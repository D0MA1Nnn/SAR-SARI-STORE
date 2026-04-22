<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'violation';

    protected $fillable = [
        'description',
    ];

    public function blockLists(): HasMany
    {
        return $this->hasMany(BlockList::class, 'violation_id');
    }
}
