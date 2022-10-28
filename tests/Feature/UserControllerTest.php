<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user_method()
    {
        /** @var User $user */
        $user = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($user)
            ->post('/api/users', [
                'name' => 'testing',
                'email' => 'test@test.com',
                'password' => 'test',
                'is_admin' => false
            ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_create_user_method_with_not_admin()
    {
        /** @var User $user */
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)
            ->post('/api/users', [
                'name' => 'testing',
                'email' => 'test@test.com',
                'password' => 'test',
                'is_admin' => false
            ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
