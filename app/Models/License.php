<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'challan_id',
        'old_license_number',
        'new_license_number',
        'renewal_date',
        'license_expiry',
        'license_document',
        'renewed_by',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function challan(): BelongsTo
    {
        return $this->belongsTo(Challan::class);
    }
}
