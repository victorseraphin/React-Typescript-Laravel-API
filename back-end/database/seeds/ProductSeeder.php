<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('products')->delete();
      DB::table('products')->insert([
          'name' => 'Play Station 4',
          'description' => 'Play Station 4',
          'price' => 3000,
          'category' => 'MLB11172',
          'qty' => 20,
      ]);
      DB::table('products')->insert([
          'name' => 'Controle Play Station 4',
          'description' => 'Controle Play Station 4',
          'price' => 200,
          'category' => 'MLB118902',
          'qty' => 50,
      ]);
      DB::table('products')->insert([
          'name' => 'Jogo PS4 Fifa 2019',
          'description' => 'Jogo PS4 Fifa 2019',
          'price' => 150,
          'category' => 'MLB186456',
          'qty' => 100,
      ]);
      
    }
}
