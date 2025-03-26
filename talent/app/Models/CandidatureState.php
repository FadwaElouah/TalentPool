<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidatureState extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color'];

    // Constants for states
    public const SUBMITTED = 'submitted';
    public const REVIEWING = 'reviewing';
    public const INTERVIEW = 'interview';
    public const REJECTED = 'rejected';
    public const ACCEPTED = 'accepted';

    public function candidatures()
    {
        return $this->hasMany(Candidature::class, 'candidature_state_id');
    }
}
