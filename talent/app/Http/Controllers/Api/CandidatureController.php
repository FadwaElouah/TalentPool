<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Candidature\StoreCandidatureRequest;
use App\Http\Requests\Candidature\UpdateCandidatureStatusRequest;
use App\Http\Resources\CandidatureResource;
use App\Services\CandidatureService;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    protected $candidatureService;

    public function __construct(CandidatureService $candidatureService)
    {
        $this->candidatureService = $candidatureService;
        $this->middleware('auth:api');
        $this->middleware('candidate')->only(['store', 'index', 'withdraw']);
        $this->middleware('recruiter')->only(['jobApplications', 'updateStatus']);
    }

    public function index()
    {
        $candidatures = $this->candidatureService->getUserCandidatures();
        return CandidatureResource::collection($candidatures);
    }

    public function store(StoreCandidatureRequest $request, $offerId)
    {
        $candidature = $this->candidatureService->apply(
            $offerId,
            $request->file('cv'),
            $request->file('cover_letter'),
            $request->input('notes')
        );

        return new CandidatureResource($candidature);
    }

    public function withdraw($id)
    {
        $result = $this->candidatureService->withdraw($id);

        if (!$result) {
            return response()->json(['message' => 'Candidature not found or you are not authorized'], 404);
        }

        return response()->json(['message' => 'Candidature withdrawn successfully']);
    }

    public function jobApplications($offerId)
    {
        $candidatures = $this->candidatureService->getOfferCandidatures($offerId);
        return CandidatureResource::collection($candidatures);
    }

    public function updateStatus(UpdateCandidatureStatusRequest $request, $id)
    {
        $candidature = $this->candidatureService->updateStatus(
            $id,
            $request->input('status_id')
        );

        if (!$candidature) {
            return response()->json(['message' => 'Candidature not found'], 404);
        }

        return new CandidatureResource($candidature);
    }
}
