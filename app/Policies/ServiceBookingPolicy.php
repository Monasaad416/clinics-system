<?php

namespace App\Policies;

use App\Models\ServiceBooking;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ServiceBookingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, ServiceBooking $service_booking): bool
    {
         return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ServiceBooking $service_booking): bool
    {
        return ($user->branch_id === $service_booking->branch_id  || $user->roles_name == ["superadmin"]);
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
    public function update(User $user, ServiceBooking $service_booking): bool
    {
        return ($user->branch_id === $service_booking->branch_id  || $user->roles_name == ["superadmin"]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ServiceBooking $service_booking): bool
    {
        return ($user->branch_id === $service_booking->branch_id  || $user->roles_name == ["superadmin"]);
    }

    public function print(User $user, ServiceBooking $service_booking): bool
    {
        return ($user->branch_id === $service_booking->branch_id  || $user->roles_name == ["superadmin"]);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ServiceBooking $service_booking): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ServiceBooking $service_booking): bool
    {
        //
    }
}
