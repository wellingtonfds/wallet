<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserUnrestricted;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('/api/user?per_page=20');

        $response->assertStatus(200);
    }

    public function test_store()
    {
        $user = UserUnrestricted::factory()->test()->make();
        $response = $this->json('POST', '/api/user', $user->toArray());
        $response->assertStatus(201);
    }

    public function test_update()
    {
        $user = User::factory()->create();

        $user->name = 'Test update name';

        $response = $this->json('put', '/api/user/' . $user->id, $user->toArray());

        $response->assertStatus(200);
        $user->delete();
    }
}
