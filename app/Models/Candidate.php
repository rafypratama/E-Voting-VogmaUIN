<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'candidate_number',
    'name',
    'gender',
    'faculty',
    'prodi',
    'photo_path',
    'bio',
    'vision',
    'mission',
    'current_votes'
])]
class Candidate extends Model
{
    use HasFactory;

    /**
     * Get the payments for the candidate.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
