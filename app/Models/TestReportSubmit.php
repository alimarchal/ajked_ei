<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestReportSubmit extends Model
{
    protected $fillable = [
        'user_id',
        'test_report_id',
        'division_sub_division_id',
        'phase_id',
        'submit_by_role',
        'submit_to_role',
        'remarks',
    ];

    use HasFactory;

    public function test_report(): BelongsTo
    {
        return $this->belongsTo(TestReport::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
