<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemInstance extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
    ];

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class, 'instance_id');
    }
}
