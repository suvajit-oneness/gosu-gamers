<?php

use Illuminate\Database\Seeder;

class GamerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Gamer::class, 12)->create();
    }
}
