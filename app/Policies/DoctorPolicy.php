<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Branch;
use App\Models\Doctor;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Request;

class DoctorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Doctor $doctor): bool
    {
        return ($user->branch_id === $doctor->branch_id  || $user->roles_name == ["superadmin"]);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user,Branch $branch,Request $request): bool
    {
        return true || $user->roles_name == ["superadmin"];
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Doctor $doctor): bool
    {
        return ($user->branch_id === $doctor->branch_id  || $user->roles_name == ["superadmin"]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Doctor $doctor): bool
    {
        return ($user->branch_id === $doctor->branch_id  || $user->roles_name == ["superadmin"]);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Doctor $doctor): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Doctor $doctor): bool
    {
        //
    }
}
