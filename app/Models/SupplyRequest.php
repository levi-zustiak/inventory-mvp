<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupplyRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'requested_by',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'timestamp'
    ];

    public function supply(): BelongsTo
    {
        return $this->belongsTo('supply_id');
    }
}
