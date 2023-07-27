<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'challan_id',
        'phase_id',
        'phase_type_id',
        'date',
        'division_sub_division_id',
        'transformer_capacity',
        'consumer_name',
        'father_husband_name',
        'cnic',
        'mobile_number',
        'complete_address',
        'insulation',
        'continuity',
        'earthing',
        'wc_test_report_fee',
        'agreement',
        'wc_verified',
        'sdo_verified',
        'xen_verified',
        'dei_aei_verified',
        'ei_verified',
        'noc_issued',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function challan()
    {
        return $this->belongsTo(Challan::class);
    }

    public function phase_type()
    {
        return $this->belongsTo(PhaseType::class);
    }


    public function phase(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Phase::class);
    }

    public function divisionSubDivision()
    {
        return $this->belongsTo(DivisionSubDivision::class);
    }


    public function loadDetails()
    {
        return $this->hasMany(LoadDetail::class);
    }
}
