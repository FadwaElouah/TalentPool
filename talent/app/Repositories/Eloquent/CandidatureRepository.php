<?php

namespace App\Repositories\Eloquent;

use App\Models\Candidature;
use App\Repositories\Interfaces\CandidatureRepositoryInterface;

class CandidatureRepository extends BaseRepository implements CandidatureRepositoryInterface
{
    public function __construct(Candidature $model)
    {
        parent::__construct($model);
    }

    public function getOfferCandidatures($offerId)
    {
        return $this->model->where('offer_post_id', $offerId)->get();
    }

    public function getUserCandidatures($userId)
    {
        return $this->model->where('user_id', $userId)->get();
    }

    public function updateStatus($id, $statusId)
    {
        return $this->update($id, ['candidature_state_id' => $statusId]);
    }
}
