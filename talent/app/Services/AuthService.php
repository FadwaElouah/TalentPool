<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);


        $token = JWTAuth::fromUser($user);

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function login(array $credentials)
    {
        if (!$token = Auth::attempt($credentials)) {
            return false;
        }

        // Retrieve the authenticated user
        $user = Auth::user();

        // Get the user's ID
        $userId = $user->id;

        // Optionally, generate a JWT token from the user
        $token = JWTAuth::fromUser($user);

        return [
            'user' => $user,
            'user_id' => $userId,
            'token' => $token
        ];
    }


    public function logout()
    {
        try {
            Auth::logout();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function me()
    {
        return Auth::user();
    }

    public function refresh()
    {
        return [
            'token' => Auth::refresh()
        ];
    }
}
