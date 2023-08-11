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
        'division_sub_division_id',
        'old_license_number',
        'new_license_number',
        'renewal_date',
        'license_expiry',
        'license_document',
        'recommended_by',
        'recommended_by_remarks',
        'renewed_by',
        'renewed_by_remarks',
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


    public function recommendedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recommended_by');
    }


    public function renewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'renewed_by');
    }


    public function divisionSubDivision()
    {
        return $this->belongsTo(DivisionSubDivision::class);
    }
}
