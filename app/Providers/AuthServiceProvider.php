<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Profil;
use App\Models\User;
use App\Policies\ActivitePolicy;
use App\Policies\BesoinPolicy;
use App\Policies\IntervenantPolicy;
use App\Policies\ProfilPolicy;
use App\Policies\ProjetPolicy;
use App\Policies\RapportPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => ProfilPolicy::class,
        User::class => ProjetPolicy::class,
        User::class => BesoinPolicy::class,
        User::class => RapportPolicy::class,
        User::class => ActivitePolicy::class,
        User::class => ClentPolicy::class,
        User::class => IntervenantPolicy::class,
        User::class => UserPolicy::class,
        User::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('update-post', function (User $user, Profil $profil) {
            return $user->id === $profil->user_id;
        });
    }
}
