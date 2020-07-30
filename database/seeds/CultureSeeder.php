<?php

use Illuminate\Database\Seeder;
use App\Models\Culture;

class CultureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 20 products and insert in the DB
        factory(Culture::class, 20 )->create();
    }
}
