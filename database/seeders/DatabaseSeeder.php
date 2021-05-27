<?php

namespace Database\Seeders;

use App\Models\Balance;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create()->each(function ($user) {
            $user->balance()->saveMany((Balance::factory(rand(2, 5))->make()));
        });
        User::factory(10)->legal()->create()->each(function ($user) {
            $user->balance()->saveMany((Balance::factory(rand(2, 5))->make()));
        });
        $this->call(TransactionsSeeder::class, false, ['limite' => 10]);
    }
}
