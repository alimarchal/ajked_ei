<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoadDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'test_report_id',
        'type',
        'watts',
        'nos',
        'total',
        'cable_sizes',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function testReport()
    {
        return $this->belongsTo(TestReport::class);
    }
}
