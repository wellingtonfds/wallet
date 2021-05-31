<?php

namespace Tests\Feature;

use App\Models\Balance;
use App\Models\User;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store()
    {
        $payer = User::factory()->create();
        $payer->balances()->save(Balance::factory()->deposit(40)->make());

        $payee = User::factory()->legal()->create();

        $response = $this->json('post', '/api/transaction', [
            'payer' => $payer->id,
            'payee' => $payee->id,
            'value' => rand(1, 40)
        ]);
        $response->assertStatus(201);
    }

    public function test_storeError()
    {
        $payer = User::factory()->create();
        $payer->balances()->save(Balance::factory()->deposit(40)->make());

        $payee = User::factory()->legal()->create();
        $payer->balances()->save(Balance::factory()->deposit(40)->make());
        $response = $this->json('post', '/api/transaction', [
            'payer' => $payee->id,
            'payee' => $payer->id,
            'value' => rand(1, 40)
        ]);
        $response->assertStatus(422);
    }

    public function test_storeEmptyBalance()
    {
        $payer = User::factory()->create();
        $payee = User::factory()->legal()->create();
        $response = $this->json('post', '/api/transaction', [
            'payer' => $payer->id,
            'payee' => $payee->id,
            'value' => rand(1, 40)
        ]);
        $response->assertStatus(422);
    }
}
