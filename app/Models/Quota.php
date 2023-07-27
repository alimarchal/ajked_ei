<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quota extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'challan_id',
        'type',
        'quantity',
        'outstanding_balance',
        'approved_by',
        'remarks',
        'status',
    ];


    public function challan(): BelongsTo
    {
        return $this->belongsTo(Challan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
