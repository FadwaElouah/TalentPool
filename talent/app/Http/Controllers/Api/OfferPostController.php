<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\OfferPost\StoreOfferPostRequest;
use App\Http\Requests\OfferPost\UpdateOfferPostRequest;
use App\Http\Resources\OfferPostResource;
use App\Services\OfferPostService;
use Illuminate\Http\Request;

class OfferPostController extends Controller
{
    protected $offerPostService;

    public function __construct(OfferPostService $offerPostService)
    {
        $this->offerPostService = $offerPostService;
        $this->middleware('auth:api');
        $this->middleware('recruiter')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        $offers = $this->offerPostService->getAllOffers();
        return OfferPostResource::collection($offers);
    }

    public function store(StoreOfferPostRequest $request)
    {
        $offer = $this->offerPostService->createOffer($request->validated());
        return new OfferPostResource($offer);
    }

    public function show($id)
    {
        $offer = $this->offerPostService->getOffer($id);
        if (!$offer) {
            return response()->json(['message' => 'Offer not found'], 404);
        }
        return new OfferPostResource($offer);
    }

    public function update(UpdateOfferPostRequest $request, $id)
    {
        $offer = $this->offerPostService->updateOffer($id, $request->validated());
        if (!$offer) {
            return response()->json(['message' => 'Offer not found'], 404);
        }
        return new OfferPostResource($offer);
    }

    public function destroy($id)
    {
        $result = $this->offerPostService->deleteOffer($id);
        if (!$result) {
            return response()->json(['message' => 'Offer not found'], 404);
        }
        return response()->json(['message' => 'Offer deleted successfully']);
    }

    public function recruiterOffers()
    {
        $offers = $this->offerPostService->getRecruiterOffers();
        return OfferPostResource::collection($offers);
    }
}
