<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class RegistrationTest extends TestCase
{

    /**
     *
     */
    public function test_it_requires_a_name(): void
    {
        $this->postJson('api/auth/register')
            ->assertJsonValidationErrors(['name']);
    }

    /**
     *
     */
    public function test_it_requires_an_username(): void
    {
        $this->postJson('api/auth/register')
            ->assertJsonValidationErrors(['username']);
    }

    /**
     *
     */
    public function test_it_requires_an_email(): void
    {
        $this->postJson('api/auth/register')
            ->assertJsonValidationErrors(['email']);
    }

    /**
     *
     */
    public function test_it_requires_a_password(): void
    {
        $this->postJson('api/auth/register')
            ->assertJsonValidationErrors(['password']);
    }

    /**
     *
     */
    public function test_it_requires_a_valid_email(): void
    {
        $this->postJson('api/auth/register', [
            'name' => 'testing',
            'username' => 'testing',
            'email' => 'test', // invalid email
            'password' => 'password',
            'password_confirmation' => 'password'
        ])
            ->assertJsonValidationErrors(['email']);
    }

    /**
     *
     */
    public function test_it_requires_a_unique_email(): void
    {
        $existingUser = factory(User::class)->create();

        $this->postJson('api/auth/register', [
            'name' => 'testing',
            'username' => 'testing',
            'email' => $existingUser->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ])
            ->assertJsonValidationErrors(['email']);
    }

    /**
     *
     */
    public function test_it_requires_a_unique_username(): void
    {
        $existingUser = factory(User::class)->create();

        $this->postJson('api/auth/register', [
            'name' => 'testing',
            'username' => $existingUser->username,
            'email' => 'testing@testing.nl',
            'password' => 'password',
            'password_confirmation' => 'password'
        ])
            ->assertJsonValidationErrors(['username']);
    }

    /**
     *
     */
    public function test_it_requires_a_mininum_password_length_of_six(): void
    {
        $this->postJson('api/auth/register', [
            'name' => 'testing',
            'username' => 'testing',
            'email' => 'testing@testing.nl',
            'password' => '12345',
            'password_confirmation' => '12345'
        ])
            ->assertJsonValidationErrors(['password']);
    }

    /**
     *
     */
    public function test_it_requires_password_confirmation(): void
    {
        $this->postJson('api/auth/register', [
            'name' => 'testing',
            'username' => 'testing',
            'email' => 'testing@testing.nl',
            'password' => '1234567',
            'password_confirmation' => '12345645'
        ])
            ->assertJsonValidationErrors(['password']);
    }

    /**
     *
     */
    public function test_it_creates_successfully_a_new_user(): void
    {
        $response = $this->postJson('api/auth/register', [
            'name' => $name = 'testing',
            'username' => $username = 'testing',
            'email' => $email = 'testing@testing.nl',
            'password' => 'passw ord',
            'password_confirmation' => 'passw ord'
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'username',
                    'email'
                ]
            ]);

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email,
            'username' => $username
        ]);
    }

}
