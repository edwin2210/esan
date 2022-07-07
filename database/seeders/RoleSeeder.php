<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->role();
    }

    public function role()
    {
        $faker = Faker::create();
        \DB::table('role')->insert([
            [
                'name' => "Administrador",
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => "Gerente",
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => "Mesero",
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
        ]);
    }
}
