<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{

    /**
     *
     */
    public function test_it_requires_an_email(): void
    {
        $this->postJson('api/auth/login', ['password' => 'password'])
            ->assertJsonValidationErrors(['email']);
    }

    /**
     *
     */
    public function test_it_requires_a_password(): void
    {
        $this->postJson('api/auth/login', ['email' => 'email@email.nl'])
            ->assertJsonValidationErrors(['password']);
    }

    /**
     *
     */
    public function test_it_requires_a_valid_email(): void
    {
        $this->postJson('api/auth/login', [
            'email' => 'test', // invalid email
            'password' => 'password',
        ])
            ->assertJsonValidationErrors(['email']);
    }

    /**
     *
     */
    public function test_it_requires_a_mininum_password_length_of_six(): void
    {
        $this->postJson('api/auth/login', [
            'email' => 'testing@testing.nl',
            'password' => '12345',
        ])
            ->assertJsonValidationErrors(['password']);
    }

    /**
     *
     */
    public function test_it_failed_log_in_an_user(): void
    {
        $user = factory(User::class)->create();

        $response = $this->postJson('api/auth/login', [
            'email' => $user->email,
            'password' => 'wrongPassword'
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'account'
            ]);
    }

    /**
     *
     */
    public function test_it_successfully_log_in_an_user(): void
    {
        $user = factory(User::class)->create([
            'password' => $password = 'password'
        ]);

        $response = $this->postJson('api/auth/login', [
            'email' => $user->email,
            'password' => $password
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'token'
                ]
            ]);
    }

}
