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

    public function test_storeError()
    {
        $user = User::factory()->test()->make();
        $response = $this->json('POST', '/api/user', $user->toArray());
        $response->assertStatus(422);
    }

    public function test_update()
    {
        $user = UserUnrestricted::factory()->create();
        $user->name = 'Test update name';
        $response = $this->json('put', '/api/user/' . $user->id, $user->toArray());
        $response->assertStatus(200);
        $user->delete();
    }

    public function test_updateError()
    {
        $user = User::factory()->create();
        $user->name = 'Test update name';
        $response = $this->json('put', '/api/user/' . $user->id, $user->toArray());
        $response->assertStatus(422);
        $user->delete();
    }

    public function test_delete()
    {
        $user = UserUnrestricted::factory()->create();
        $response = $this->json('delete', '/api/user/' . $user->id);
        $response->assertStatus(200);
        $user->delete();
    }

    public function test_deleteError()
    {
        $response = $this->json('delete', '/api/user/'.rand(200,99999));
        $response->assertStatus(404);
    }
}
