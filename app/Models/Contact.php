<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model
{
    protected $fillable = [
        'family_id',
        'relationship_id',
        'name',
        'email',
        'address',
    ];

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    public function relationship(): BelongsTo
    {
        return $this->belongsTo(Relationship::class);
    }

    public function phoneNumbers(): HasMany
    {
        return $this->hasMany(PhoneNumber::class);
    }
}
