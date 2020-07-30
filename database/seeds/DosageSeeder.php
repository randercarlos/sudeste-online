<?php

use Illuminate\Database\Seeder;
use App\Models\Dosage;

class DosageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 20 products and insert in the DB
        factory(Dosage::class, 20 )->create();
    }
}
