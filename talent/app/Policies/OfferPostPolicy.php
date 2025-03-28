<?php

namespace App\Policies;

use App\Models\OfferPost;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, OfferPost $offerPost)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->isRecruiter();
    }

    public function update(User $user, OfferPost $offerPost)
    {
        return $user->id === $offerPost->user_id || $user->isAdmin();
    }

    public function delete(User $user, OfferPost $offerPost)
    {
        return $user->id === $offerPost->user_id || $user->isAdmin();
    }
}
