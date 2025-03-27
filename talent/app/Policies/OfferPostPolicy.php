<?php

namespace App\Policies;

use App\Models\OfferPost;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OfferPost $offerPost)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->isRecruiter();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OfferPost $offerPost)
    {
        return $user->id === $offerPost->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OfferPost $offerPost)
    {
        return $user->id === $offerPost->user_id || $user->isAdmin();
    }
}
