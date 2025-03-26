<?php

namespace App\Repositories\Interfaces;

interface OfferPostRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getActiveOffers();
    public function getRecruiterOffers($recruiterId);
}
