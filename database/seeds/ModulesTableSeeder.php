<?php

use Illuminate\Database\Seeder;
use ORC\Module;
use ORC\Category;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wineCategory = Category::where('name','Wine')->pluck('id')->first();
        $coffeeCategory = Category::where('name','Coffee')->pluck('id')->first();
        
        Module::create([
            'name' => 'Red wine',
            'description' => 'wine good',
            'image' => null,
            'category_id' => $wineCategory,
        ]);
        
        Module::create([
            'name' => 'White wine',
            'description' => 'wine good',
            'image' => null,
            'category_id' => $wineCategory,
        ]);
        
        Module::create([
            'name' => 'Spumante',
            'description' => 'wine with bubbles',
            'image' => null,
            'category_id' => $wineCategory,
        ]);
        
         Module::create([
            'name' => 'Castelcovati wine',
            'description' => 'null',
            'image' => null,
            'category_id' => $wineCategory,
        ]);
        
          Module::create([
            'name' => 'American coffee',
            'description' => null,
            'image' => null,
            'category_id' => $coffeeCategory,
        ]);
        
    }
}


