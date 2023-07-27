<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Challan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'challan_type_id',
        'amount',
        'status',
        'challan_receipt_path',
        'verified_by_user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function challan_type(): BelongsTo
    {
        return $this->belongsTo(ChallanType::class);
    }
}
