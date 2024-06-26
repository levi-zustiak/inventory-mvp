<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'assigned_by',
        'assigned_to',
        'quantity',
        'returned_at',
    ];

    protected $casts = [
        'returned_at' => 'timestamp'
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
