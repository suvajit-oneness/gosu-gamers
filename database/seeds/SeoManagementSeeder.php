<?php

use Illuminate\Database\Seeder;

class 
 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Seo_management::class, 12)->create();
    }
}
