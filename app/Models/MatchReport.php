<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MatchReport extends Model
{
    use HasFactory;


    public function referee(): BelongsTo
    {
        return $this->belongsTo(Referee::class);
    }

    public function fixture(): BelongsTo
    {
        return $this->belongsTo(Fixture::class);
    }
    
}
