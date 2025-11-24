<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RuntimeException;

trait HandlesSocialAuthentication
{
    /**
     * Create or update a user based on social provider response, assign customer role, and authenticate the user.
     *
     * @param  \Laravel\Socialite\Contracts\User  $providerUser
     * @param  string  $provider
     * @return array{0: \App\Models\User, 1: bool}
     */
    protected function resolveSocialUser($providerUser, string $provider): array
    {
        $email = $providerUser->getEmail();

        if (empty($email)) {
            throw new RuntimeException(__('common.social_login_email_required', ['provider' => ucfirst($provider)]));
        }

        $user = User::firstOrNew(['email' => $email]);
        $isNewUser = !$user->exists;
        $temporaryPassword = null;

        if ($isNewUser) {
            $user->name = $providerUser->getName() ?: ($providerUser->getNickname() ?: $email);
            $temporaryPassword = Str::random(32);
            $user->password = Hash::make($temporaryPassword);
            $user->provider_name = $provider;
            $user->provider_id = $providerUser->getId();
        }

        $user->email_verified_at = $user->email_verified_at ?: now();
        $user->save();

        $this->ensureCustomerRole($user);

        // Send email with temporary password for new users
        if ($isNewUser && $temporaryPassword) {
            $this->sendTemporaryPasswordEmail($user, $temporaryPassword);
        }

        Auth::login($user, true);

        return [$user, $isNewUser];
    }

    protected function ensureCustomerRole(User $user): void
    {
        $customerRole = Role::firstOrCreate(['name' => 'Customer']);

        if (!$user->roles()->where('roles.id', $customerRole->id)->exists()) {
            $user->roles()->attach($customerRole->id);
        }
    }

    protected function sendTemporaryPasswordEmail(User $user, string $temporaryPassword): void
    {
        try {
            Mail::raw(
                __('common.temporary_password_email_body', [
                    'name' => $user->name,
                    'password' => $temporaryPassword,
                ]),
                function ($message) use ($user) {
                    $message->to($user->email)
                        ->subject(__('common.temporary_password_email_subject'));
                }
            );
        } catch (\Exception $e) {
            // Log error but don't fail the authentication process
            \Log::error('Failed to send temporary password email', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}



