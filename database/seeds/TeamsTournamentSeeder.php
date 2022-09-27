<?php

use Illuminate\Database\Seeder;

class TeamsTournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Teams_tournament::class, 20)->create();
    }
}
