<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stadium extends Model
{
    use HasFactory;



    public function Team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
