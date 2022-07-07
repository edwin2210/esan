<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class, //Catalog
            UserSeeder::class, //Catalog
            ProductSeeder::class, //Catalog
            TableSeeder::class,
        ]);
    }
}
