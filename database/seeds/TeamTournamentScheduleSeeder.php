<?php

use Illuminate\Database\Seeder;

class TeamTournamentScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Team_tournament_schedule::class, 20)->create();
    }
}
