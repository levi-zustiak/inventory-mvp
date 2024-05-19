<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ItemInstance extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
    ];

    public function assignment(): HasOne
    {
        return $this->hasOne(Assignment::class, 'instance_id');
    }
}
