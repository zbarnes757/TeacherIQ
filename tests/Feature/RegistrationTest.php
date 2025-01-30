<?php

use App\Enums\UserAccountType;
use App\Models\TeacherProfile;
use App\Models\User;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;

test('registration screen can be rendered', function (): void {
    $response = $this->get('/register');

    $response->assertStatus(200);
})->skip(fn() => ! Features::enabled(Features::registration()), 'Registration support is not enabled.');

test('registration screen cannot be rendered if support is disabled', function (): void {
    $response = $this->get('/register');

    $response->assertStatus(404);
})->skip(fn() => Features::enabled(Features::registration()), 'Registration support is enabled.');

test('new users can register', function (): void {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'account_type' => UserAccountType::Teacher->value,
        'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('teachers.home', absolute: false));
})->skip(fn() => ! Features::enabled(Features::registration()), 'Registration support is not enabled.');


test('users registering as a teacher create a teacher_profile', function (): void {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'account_type' => UserAccountType::Teacher->value,
        'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('teachers.home', absolute: false));
    $user = User::where('email', 'test@example.com')->first();

    $this->assertTrue(TeacherProfile::where('user_id', $user->id)->exists());
});
