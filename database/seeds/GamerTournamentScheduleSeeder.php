<?php

use Illuminate\Database\Seeder;

class GamerTournamentScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         factory(App\Models\Gamer_tournament_schedule::class, 12)->create();


        
    }
}
