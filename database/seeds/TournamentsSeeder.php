<?php

use Illuminate\Database\Seeder;

class TournamentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Tournaments::class, 12)->create();
    }
}
