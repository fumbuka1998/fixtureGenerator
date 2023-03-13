<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Referee extends Model
{
    use HasFactory;


    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Referee_role::class);
    }
}
