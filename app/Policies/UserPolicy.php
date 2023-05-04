<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user,Branch $branch): bool
    {
        //  return $user->branch_id === $branch->id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Branch $branch): bool
    {
        //    if ($branch->id == $user->branch_id) {
        //     return true;
        // }

        //  return $user->branch_id === $branch->id;
    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Branch $branch): bool
    {
        return true;
    }

    public function update(User $user): bool
    {

        return  $user->roles_name == ["superadmin"] ;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Branch $branch): bool
    {
        return ($user->branch_id === $branch->id || $user->roles_name == ['superadmin']) ;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        //
    }
}
