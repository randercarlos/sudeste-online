<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

//        $this->call(PragueSeeder::class);
//        $this->call(ProductSeeder::class);
//        $this->call(CultureSeeder::class);
        $this->call(DosageSeeder::class);
        $this->call(UserSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
