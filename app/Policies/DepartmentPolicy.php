<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Department $department)
    {
        if ($department->users->isEmpty()) {
            return true;
        }
    }
}
