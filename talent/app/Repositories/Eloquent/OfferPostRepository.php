<?php

namespace App\Repositories\Eloquent;

use App\Models\OfferPost;
use App\Repositories\Interfaces\OfferPostRepositoryInterface;

class OfferPostRepository implements OfferPostRepositoryInterface
{
    protected $model;

    public function __construct(OfferPost $model)
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

    public function getActiveOffers()
    {
        return $this->model->where('is_active', true)
            ->where('deadline', '>=', now())
            ->get();
    }

    public function getRecruiterOffers($recruiterId)
    {
        return $this->model->where('user_id', $recruiterId)->get();
    }
}
