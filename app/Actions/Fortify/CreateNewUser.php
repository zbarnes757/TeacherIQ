<?php

namespace App\Actions\Fortify;

use App\Enums\UserAccountType;
use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\Rule;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'account_type' => ['required', Rule::enum(UserAccountType::class)],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'account_type' => $input['account_type'],
        ]);

        switch ($user->account_type) {
            case UserAccountType::Teacher:
                Log::info('Creating Teacher profile for ' . $user->id);
                $profile = new TeacherProfile();
                $profile->user_id = $user->id;
                $profile->save();
                break;
            default:
                Log::warning('No profile to be created for ' . $user->id);
        }

        return $user;
    }
}
