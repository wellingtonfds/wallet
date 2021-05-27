<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($limite)
    {
        for ($i = 0; $i < $limite; $i++) {
            $users = User::inRandomOrder()->take(2)->get();
            $payer = $users[0];
            $payee = $users[1];
            Transaction::create([
                'payer' => $payer->id,
                'payee' => $payee->id,
                'value' => random_int(2, 100)
            ]);
        }
    }
}
