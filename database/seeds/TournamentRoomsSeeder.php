<?php

use Illuminate\Database\Seeder;

class TournamentRoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         factory(App\Models\Tournament_rooms::class, 20)->create();
    }
}
