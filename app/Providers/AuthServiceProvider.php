<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Person;
use App\Models\HistoryClinic;
use App\Models\AppointmentMedical;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('haveaccess', function (User $user, $perm){
            return $user->havePermission($perm);
        });

        Gate::define('haveaccessUser', function (User $usera, User $user, $perm){

            if ($usera->havePermission($perm)) {
              return $usera->id == $user->creator_id;
            }
            return false;
        });

        Gate::define('haveaccessHistoryClinic', function (User $usera, HistoryClinic $history, $perm){

            if ($usera->havePermission($perm)) {
              return $usera->id == $history->person->user->creator_id;
            }
            return false;
        });

        Gate::define('haveaccesscreateHistoryClinic', function (User $usera, User $user, $perm){

            if ($usera->havePermission($perm) && $user->havePermission('appointmentmedical.create')) {
              return $usera->id == $user->creator_id;
            }
            return false;
        });

        Gate::define('haveaccesscreateMedicalConsultations', function (User $usera, Person $person, $perm){

            if ($usera->havePermission($perm) && $person->user->havePermission('appointmentmedical.create')) {
              return $usera->id == $person->user->creator_id;
            }
            return false;
        });

        Gate::define('haveaccessshowAppointmentMedical', function (User $user, AppointmentMedical $appointment, $perm){

          if ($user->havePermission($perm[0]) && $user->havePermission($perm[1])) {
            return $user->id == $appointment->doctor_id;
          }
          return false;
        });

        Passport::routes();

    }
}
