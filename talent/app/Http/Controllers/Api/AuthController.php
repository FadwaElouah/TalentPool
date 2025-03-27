<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->middleware('jwt.verify', ['except' => ['login', 'register']]);
    }




    public function register(RegisterRequest $request)
    {
        $result = $this->authService->register($request->validated());

        if (!$result) {
            return response()->json(['error' => 'Une erreur s\'est produite lors de l\'inscription'], 500);
        }

        return response()->json($result,201);
    }



    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request->validated());

        if (!$result) {
            return response()->json(['error' => 'Identifiants invalides'], 401);
        }

        return response()->json($result , 200);
    }








    public function logout()
    {
        $result = $this->authService->logout();

        if (!$result) {
            return response()->json(['error' => "Une erreur s'est produite lors de la déconnexion"], 500);
        }

        return response()->json(['message' => 'Vous vous êtes déconnecté avec succès']);
    }

    public function me()
    {
        $user = $this->authService->me();

        if (!$user) {
            return response()->json(['error' => 'Non autorisé'], 401);
        }

        return response()->json($user);
    }

    public function refresh()
    {
        return response()->json($this->authService->refresh());
    }
}
