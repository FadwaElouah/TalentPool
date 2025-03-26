<?php

namespace App\Repositories\Interfaces;

interface CandidatureRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getOfferCandidatures($offerId);
    public function getUserCandidatures($userId);
    public function updateStatus($id, $statusId);
}
