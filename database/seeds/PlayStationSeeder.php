<?php

use Illuminate\Database\Seeder;

class PlayStationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Play_station::class, 15)->create();
    }
}
