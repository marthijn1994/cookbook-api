<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class LogoutTest extends TestCase
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
    public function test_if_user_can_logout(): void
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user, 'POST', 'api/auth/logout');

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'message' => __('auth.logged_out')
            ]);
    }

}
