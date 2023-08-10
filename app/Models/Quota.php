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
        'division_sub_division_id',
        'test_report_id',
        'phase_type_id',
        'type',
        'quantity',
        'outstanding_balance',
        'recommended_by',
        'recommended_by_remarks',
        'approved_by',
        'approved_by_remarks',
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


    public function phase_type(): BelongsTo
    {
        return $this->belongsTo(PhaseType::class);
    }

    public function testReport()
    {
        return $this->belongsTo(TestReport::class);
    }


    public function recommendedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recommended_by');
    }


    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }


    public function divisionSubDivision()
    {
        return $this->belongsTo(DivisionSubDivision::class);
    }



}
