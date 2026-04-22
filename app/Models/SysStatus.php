<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class SysStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'sys_status';

    protected $fillable = [
        'description',
    ];

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'payment_status_id');
    }
}
