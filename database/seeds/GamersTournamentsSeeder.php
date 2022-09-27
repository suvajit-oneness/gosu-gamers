<?php

use Illuminate\Database\Seeder;

class GamersTournamentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          factory(App\Models\Gamers_tournaments::class, 12)->create();
    }
}
