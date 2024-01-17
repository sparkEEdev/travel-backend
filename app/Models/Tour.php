<?php

namespace App\Models;

use App\Concerns\FormatMoney;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'travelId',
        'name',
        'startDate',
        'endDate',
        'numberOfPeople',
        'price',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => $value
        );
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            set: fn(int $value) => FormatMoney::toDatabase($value)
        );
    }

    protected function formattedPrice(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => FormatMoney::toReadable((int) $attributes['price']),
        );
    }


    public function travel(): BelongsTo
    {
        return $this->belongsTo(Travel::class, 'travelId');
    }

    public function scopeWhereTravelSlug(Builder $query, string $slug): void
    {
        $query->whereHas('travel', fn(Builder $query) => $query->where('slug', $slug));
    }
}
