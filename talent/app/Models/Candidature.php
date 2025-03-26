<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'offer_post_id',
        'candidature_state_id',
        'cv_path',
        'cover_letter_path',
        'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offerPost()
    {
        return $this->belongsTo(OfferPost::class, 'offer_post_id');
    }

    public function state()
    {
        return $this->belongsTo(CandidatureState::class, 'candidature_state_id');
    }
}
