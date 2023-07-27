<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'division_sub_division_id',
        'test_report_id',
        'remarks',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function divisionSubDivision()
    {
        return $this->belongsTo(DivisionSubDivision::class, 'division_sub_division_id', 'id');
    }

    public function testReport()
    {
        return $this->belongsTo(TestReport::class);
    }
}
