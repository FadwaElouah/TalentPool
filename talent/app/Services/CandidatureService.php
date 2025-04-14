<?php

namespace App\Services;

use App\Repositories\Interfaces\CandidatureRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ApplicationStatusChanged;
use App\Models\CandidatureState;

class CandidatureService
{
    protected $candidatureRepository;
    protected $fileService;

    public function __construct(
        CandidatureRepositoryInterface $candidatureRepository,
        FileService $fileService
    ) {
        $this->candidatureRepository = $candidatureRepository;
        $this->fileService = $fileService;
    }

    public function getUserCandidatures()
    {
        return $this->candidatureRepository->getUserCandidatures(Auth::id());
    }

    public function getOfferCandidatures($offerId)
    {
        return $this->candidatureRepository->getOfferCandidatures($offerId);
    }

    public function apply($offerId, $cvFile, $coverLetterFile = null, $notes = null)
    {
        $cvPath = $this->fileService->uploadFile($cvFile, 'cvs');
        $coverLetterPath = null;

        if ($coverLetterFile) {
            $coverLetterPath = $this->fileService->uploadFile($coverLetterFile, 'cover_letters');
        }

        $submittedStatusId = CandidatureState::where('name', 'submitted')->first()->id;

        return $this->candidatureRepository->create([
            'user_id' => Auth::id(),
            'offer_post_id' => $offerId,
            'candidature_state_id' => $submittedStatusId,
            'cv_path' => $cvPath,
            'cover_letter_path' => $coverLetterPath,
            'notes' => $notes
        ]);
    }

    public function withdraw($id)
    {
        $candidature = $this->candidatureRepository->find($id);

        if ($candidature && $candidature->user_id === Auth::id()) {
            if ($candidature->cv_path) {
                $this->fileService->deleteFile($candidature->cv_path);
            }

            if ($candidature->cover_letter_path) {
                $this->fileService->deleteFile($candidature->cover_letter_path);
            }

            return $this->candidatureRepository->delete($id);
        }

        return false;
    }

    public function updateStatus($id, $statusId)
    {
        $candidature = $this->candidatureRepository->find($id);

        if ($candidature) {
            $result = $this->candidatureRepository->updateStatus($id, $statusId);

            if ($result) {
                $candidature = $this->candidatureRepository->find($id);
                $candidature->user->notify(new ApplicationStatusChanged($candidature));

                return $candidature;
            }
        }

        return false;
    }
}
