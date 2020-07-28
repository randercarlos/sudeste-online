<?php

use Illuminate\Database\Seeder;

class PragueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 20 products and insert in the DB
        factory(Prague::class, 20 )->create();
    }
}
