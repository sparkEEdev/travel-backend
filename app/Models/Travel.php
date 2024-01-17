<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Travel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'travels';

    protected $fillable = [
        'name',
        'description',
        'numberOfDays',
        'publishedAt',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => [
                'name' => $value,
                'slug' => Str::slug($value, '-'),
            ],
        );
    }

    protected function numberOfNights(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => $attributes['numberOfDays'] - 1,
        );
    }

    protected function isPublic(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => $attributes['publishedAt'] !== null,
        );
    }

    public function moods(): HasOne
    {
        return $this->hasOne(Mood::class, 'travelId');
    }


    public function scopePublic($query)
    {
        return $query->whereNotNull('publishedAt');
    }
}
