<?php

namespace App\Services;

use App\Repositories\Interfaces\OfferPostRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class OfferPostService
{
    protected $offerPostRepository;

    public function __construct(OfferPostRepositoryInterface $offerPostRepository)
    {
        $this->offerPostRepository = $offerPostRepository;
    }

    public function getAllOffers()
    {
        return $this->offerPostRepository->getActiveOffers();
    }

    public function getRecruiterOffers()
    {
        return $this->offerPostRepository->getRecruiterOffers(Auth::id());
    }

    public function createOffer(array $data)
    {
        $data['user_id'] = Auth::id();
        return $this->offerPostRepository->create($data);
    }

    public function updateOffer($id, array $data)
    {
        return $this->offerPostRepository->update($id, $data);
    }

    public function deleteOffer($id)
    {
        return $this->offerPostRepository->delete($id);
    }

    public function getOffer($id)
    {
        return $this->offerPostRepository->find($id);
    }
}
