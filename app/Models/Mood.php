<?php

namespace App\Models;

use App\Enums\Moods;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mood extends Model
{
    use HasFactory;

    protected $fillable = [
        'nature',
        'relax',
        'history',
        'culture',
        'party',
    ];

    public function travel(): BelongsTo
    {
        return $this->belongsTo(Travel::class, 'travelId');
    }
}
