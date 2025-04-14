<?php

namespace App\Repositories\Eloquent;

use App\Models\Candidature;
use App\Repositories\Interfaces\CandidatureRepositoryInterface;

class CandidatureRepository implements CandidatureRepositoryInterface
{
    protected $model;

    public function __construct(Candidature $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->find($id);
        if ($record) {
            $record->update($data);
            return $record;
        }
        return false;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
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
