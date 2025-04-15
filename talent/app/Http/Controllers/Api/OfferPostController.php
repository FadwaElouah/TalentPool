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

        // Middleware pour authentification + autorisation
        $this->middleware('auth:api');
        $this->middleware('recruiter')->only(['store', 'update', 'destroy']);
    }

    /**
     * Afficher toutes les offres.
     */
    public function index()
    {
        $offers = $this->offerPostService->getAllOffers();
        return OfferPostResource::collection($offers);
    }

    /**
     * Créer une nouvelle offre.
     */
    public function store(StoreOfferPostRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id(); // Associer l'offre à l'utilisateur connecté

        $offer = $this->offerPostService->createOffer($validated);
        return new OfferPostResource($offer);
    }

    /**
     * Afficher une offre spécifique.
     */
    public function show($id)
    {
        $offer = $this->offerPostService->getOffer($id);

        if (!$offer) {
            return response()->json(['message' => 'Offer not found'], 404);
        }

        return new OfferPostResource($offer);
    }

    /**
     * Mettre à jour une offre.
     */
    public function update(UpdateOfferPostRequest $request, $id)
    {
        $offer = $this->offerPostService->updateOffer($id, $request->validated());

        if (!$offer) {
            return response()->json(['message' => 'Offer not found'], 404);
        }

        return new OfferPostResource($offer);
    }

    /**
     * Supprimer une offre.
     */
    public function destroy($id)
    {
        $result = $this->offerPostService->deleteOffer($id);

        if (!$result) {
            return response()->json(['message' => 'Offer not found'], 404);
        }

        return response()->json(['message' => 'Offer deleted successfully']);
    }

    /**
     * Récupérer les offres du recruteur connecté.
     */
    public function recruiterOffers()
    {
        $offers = $this->offerPostService->getRecruiterOffers();
        return OfferPostResource::collection($offers);
    }
}
