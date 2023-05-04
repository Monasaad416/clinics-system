<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */


      protected $policies = [
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Branch' => 'App\Policies\BranchPolicy',
        'App\Models\Department' => 'App\Policies\DepartmentPolicy',
        'App\Models\Client' => 'App\Policies\ClientPolicy',
        'App\Models\Doctor' => 'App\Policies\DoctorPolicy',
        'App\Models\Offer' => 'App\Policies\OfferPolicy',
        'App\Models\Resevation' => 'App\Policies\ResevationPolicy',
        'App\Models\Service' => 'App\Policies\ServicePolicy',
        'App\Models\Specialist' => 'App\Policies\SpecialistPolicy',
        'App\Models\SubSpecialist' => 'App\Policies\SubSpecialistPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('superadmin', function(User $user) {
           return $user->roles_name == ["superadmin"];
        });

        Gate::define('admin_1', function($user) {
            return ( $user->branch_id == 1 && $user->roles_name != ["superadmin"]);
        });

        Gate::define('admin_2', function($user) {
            return ( $user->branch_id == 2 && $user->roles_name != ["superadmin"]);
        });

        Gate::define('admin_3', function($user) {
            return ( $user->branch_id == 3 && $user->roles_name != ["superadmin"]);
        });


        
        Gate::define('reception_1', function($user) {
           return ( $user->branch_id == 1 &&  ($user->roles_name == ["financial"] || $user->roles_name == ["reception"]) );
        });

        Gate::define('reception_2', function($user) {
            return ( $user->branch_id == 2 &&  ($user->roles_name == ["financial"] || $user->roles_name == ["reception"]) );
        });

        Gate::define('reception_3', function($user) {
            return ( $user->branch_id == 3 && ($user->roles_name != ["financial"] || $user->roles_name == ["reception"]));
        });


 
    }
}
