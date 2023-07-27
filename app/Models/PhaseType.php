<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhaseType extends Model
{
    use HasFactory;

    public function phase(): BelongsTo
    {
        return $this->belongsTo(Phase::class);
    }
}
