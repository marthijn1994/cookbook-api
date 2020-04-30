<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class MeTest extends TestCase
{

    /**
     *
     */
    public function test_if_user_is_authenticated(): void
    {
        $response = $this->postJson('api/auth/logout');

        $response
            ->assertStatus(401);
    }

    /**
     *
     */
    public function test_it_returns_a_logged_in_user(): void
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user, 'GET', 'api/auth/me');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'username',
                    'email'
                ]
            ]);
    }

}
