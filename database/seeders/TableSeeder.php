<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->table();
    }

    public function table()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 5; $i++) {
            \DB::table('table')->insert([
                [
                    'name' => 'Mesa '.($i+1),
                    'description' => 'Ubicación de la mesa '.($i+1),
                    'capacity' => $faker->numberBetween(2, 6),
                    'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
                ]
            ]);
        }
    }
}
