<?php

namespace App\Repositories\Eloquent;

use App\Models\OfferPost;
use App\Repositories\Interfaces\OfferPostRepositoryInterface;

class OfferPostRepository extends BaseRepository implements OfferPostRepositoryInterface
{
    public function __construct(OfferPost $model)
    {
        parent::__construct($model);
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
