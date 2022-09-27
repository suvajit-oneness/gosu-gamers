<?php

use Illuminate\Database\Seeder;

class GamerTournamentPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(App\Models\Gamer_tournament_point::class, 12)->create();
    }
}
