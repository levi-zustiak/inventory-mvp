<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'assigned_by',
        'assigned_to',
        'previous_id',
        'release_method',
    ];

    public function instance(): BelongsTo
    {
        return $this->belongsTo(ItemInstance::class, 'id', 'instance_id');
    }
}
