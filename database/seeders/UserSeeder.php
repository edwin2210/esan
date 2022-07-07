<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->user();
    }

    public function user()
    {
        $faker = Faker::create();
        \DB::table('user')->insert([
            [
                'names' => $faker->name,
                'last_names' => $faker->lastName,
                'email' => 'admin@saboranaranja.com.mx',
                'password' => \Hash::make('saboranaranja'),
                'fk_id_role' => 1,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'names' => $faker->name,
                'last_names' => $faker->lastName,
                'email' => 'manager@saboranaranja.com.mx',
                'password' => \Hash::make('saboranaranja'),
                'fk_id_role' => 2,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'names' => $faker->name,
                'last_names' => $faker->lastName,
                'email' => 'waiter@saboranaranja.com.mx',
                'password' => \Hash::make('saboranaranja'),
                'fk_id_role' => 3,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
        ]);
    }
}
