<?php

namespace App\Policies;

use App\Models\ClassOffer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassOfferPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return isset($user->teacher);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClassOffer  $class_offer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ClassOffer $class_offer)
    {
        return $user->id === $class_offer->teacher->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ClassOffer  $class_offer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ClassOffer $class_offer)
    {
        return $user->id === $class_offer->teacher->user_id;
    }
}
