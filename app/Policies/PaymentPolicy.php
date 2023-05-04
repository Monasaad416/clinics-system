<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Salary;
use App\Models\User;

class PaymentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user,Salary $salary): bool
    {
        return ($user->branch_id === $salary->branch_id  || $user->roles_name == ["superadmin"]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Salary $salary): bool
    {
         return ($user->branch_id === $salary->branch_id  || $user->roles_name == ["superadmin"]);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Salary $salary): bool
    {
         return ($user->branch_id === $salary->branch_id  || $user->roles_name == ["superadmin"]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Salary $salary): bool
    {
        return ($user->branch_id === $salary->branch_id  || $user->roles_name == ["superadmin"]);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Salary $salary): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Salary $salary): bool
    {
        //
    }
}
