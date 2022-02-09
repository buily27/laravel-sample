<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        return $user->id !== $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function updateRole(User $user, User $model)
    {
        return $user->id !== $model->id;
    }

    /**
     * Display view when user's role is Admin
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAdmin(User $user)
    {
        if ($user->is_admin == config('common.IS_ADMIN')) {
            return true;
        }
        return false;
    }

    /**
     * Display view when user's role is Admin, Management
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if ($user->is_admin == config('common.IS_ADMIN') || $user->role_id == config('common.IS_MANAGEMENT')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can reset password.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function resetPassword(User $user, User $model)
    {
        return $user->id !== $model->id;
    }
}
