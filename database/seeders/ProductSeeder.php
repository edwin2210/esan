<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->product();
    }

    public function product()
    {
        \DB::table('product')->insert([
            [
                'name' => 'Coctel de camaron chico',
                'description' => 'Coctel de camaron chico',
                'price' => 80.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Coctel de camaron mediano',
                'description' => 'Coctel de camaron mediano',
                'price' => 110.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Coctel de camaron grande',
                'description' => 'Coctel de camaron grande',
                'price' => 130.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Coctel de pulpo chico',
                'description' => 'Coctel de camaron chico',
                'price' => 80.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Coctel de pulpo mediano',
                'description' => 'Coctel de camaron mediano',
                'price' => 110.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Coctel de pulpo grande',
                'description' => 'Coctel de camaron grande',
                'price' => 130.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Coctel Vuelve a la vida',
                'description' => 'Coctel Vuelve a la vida',
                'price' => 160.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Ensalada de camaron',
                'description' => 'Ensalada de camaron',
                'price' => 180.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Ensalada de mariscos',
                'description' => 'Ensalada de mariscos',
                'price' => 180.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Ceviche tropical',
                'description' => 'Ceviche tropical',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Tostadas de camaron',
                'description' => 'Tostadas de camaron',
                'price' => 180.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Tostadas de pulpo',
                'description' => 'Tostadas de pulpo',
                'price' => 180.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Cazuela de mariscos',
                'description' => 'Cazuela de mariscos',
                'price' => 180.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Caldo de camaron',
                'description' => 'Caldo de camaron',
                'price' => 185.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Pescado frito (robalo)',
                'description' => 'Pescado frito robalo',
                'price' => 220.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Pescado frito (mojarra)',
                'description' => 'Pescado frito mojarra',
                'price' => 220.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Pescado frito (huachinango)',
                'description' => 'Pescado huachinango',
                'price' => 220.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Camarones enchipotlados',
                'description' => 'Camarones enchipotlados',
                'price' => 180.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Camarones a la mantequilla',
                'description' => 'Camarones a la mantequilla',
                'price' => 180.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Camarones al mojo de ajo',
                'description' => 'Camarones al mojo de ajo ',
                'price' => 180.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Camarones emanizados',
                'description' => 'Camarones empanizados',
                'price' => 180.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Camarones rellenos',
                'description' => 'Camarones rellenos',
                'price' => 180.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Filete a la veracruzana',
                'description' => 'Filete a la veracruzana',
                'price' => 180.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Filete empanizado',
                'description' => 'Filete empanizado',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Filete relleno de camaron',
                'description' => 'Filete relleno de camaron',
                'price' => 220.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Enchiladas de cecina rojas',
                'description' => 'Enchiladas de cecina rojas',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Enchiladas de cecina verdes',
                'description' => 'Enchiladas de cecina verdes',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Enchiladas de cecina morita',
                'description' => 'Enchiladas de cecina morita',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Enchiladas de cecina chile seco',
                'description' => 'Enchiladas de cecina chile seco',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Enchiladas de pollo frito rojas',
                'description' => 'Enchiladas de pollo frito rojas',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Enchiladas de pollo frito verdes',
                'description' => 'Enchiladas de pollo frito verdes',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Enchiladas de pollo frito morita',
                'description' => 'Enchiladas de pollo frito morita',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Enchiladas de pollo frito chile seco',
                'description' => 'Enchiladas de pollo frito chile seco',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Enchiladas de Bistec rojas',
                'description' => 'Enchiladas de Bistec rojas',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Enchiladas de Bistec verdes',
                'description' => 'Enchiladas de Bistec verdes',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Enchiladas de Bistec morita',
                'description' => 'Enchiladas de Bistec morita',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Enchiladas de Bistec chile seco',
                'description' => 'Enchiladas de Bistec chile seco',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Enchiladas de baile',
                'description' => 'Enchiladas de baile',
                'price' => 170.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Platillo huasteco',
                'description' => 'Platillo huasteco',
                'price' => 170.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Platillo arrachera',
                'description' => 'Platillo arrachera',
                'price' => 250.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Platillo pulpos encebollados',
                'description' => 'Platillo pulpos encebollados',
                'price' => 250.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Platillo ostiones a la pimienta',
                'description' => 'Platillo ostiones a la pimienta',
                'price' => 200.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Platillo pulpo a la mantequilla',
                'description' => 'Platillo pulpo a la mantequilla',
                'price' => 260.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'HF Pechuga a la plancha',
                'description' => 'HF Pechuga a la plancha',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'HF Salmon a la plancha',
                'description' => 'HF Salmon a la plancha',
                'price' => 250.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'HF Filete de epescado empapelado',
                'description' => 'HF Filete de epescado empapelado',
                'price' => 170.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'HF Aguacate relleno',
                'description' => 'HF Aguacate relleno',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'HF Calabazas rellenas',
                'description' => 'HF Calabazas rellenas',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'HF Ensaladas de frutos rojos',
                'description' => 'HF Ensaladas de frutos rojos',
                'price' => 150.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Nuggets',
                'description' => 'Nuggets',
                'price' => 60.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Papas a la francesa',
                'description' => 'Papas a la francesa',
                'price' => 30.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Hamburguesa con papas',
                'description' => 'Hamburguesa con papas',
                'price' => 100.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Jugo de naranja',
                'description' => 'Jugo de naranja',
                'price' => 50.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Jugo de verde',
                'description' => 'Jugo de verde',
                'price' => 50.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Jugo combinado',
                'description' => 'Jugo combinado',
                'price' => 50.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Agua fresca de melon',
                'description' => 'Agua fresca de melon',
                'price' => 50.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Agua fresca de piña',
                'description' => 'Agua fresca de piña',
                'price' => 50.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Agua fresca de horchata',
                'description' => 'Agua fresca de horchata',
                'price' => 50.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Agua fresca de jamaica',
                'description' => 'Agua fresca de jamaica',
                'price' => 40.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Flan napolitano',
                'description' => 'Flan napolitano',
                'price' => 40.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Arroz con leche',
                'description' => 'Arroz con leche',
                'price' => 35.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Platanos rellenos',
                'description' => 'Platanos rellenos',
                'price' => 40.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'name' => 'Pay de queso o fresa',
                'description' => 'Pay de queso o fresa',
                'price' => 45.00,
                'created_at' => \DB::raw('CURRENT_TIMESTAMP'),
            ]
        ]);
    }
}
