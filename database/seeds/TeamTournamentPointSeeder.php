<?php

use Illuminate\Database\Seeder;

class TeamTournamentPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Team_tournament_point::class, 20)->create();
    }
}
