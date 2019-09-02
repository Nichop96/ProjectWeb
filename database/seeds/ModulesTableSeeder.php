<?php

use Illuminate\Database\Seeder;
use ORC\Module;
use ORC\Category;

class ModulesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $wineCategory = Category::where('name', 'Wine')->pluck('id')->first();
        $coffeeCategory = Category::where('name', 'Coffee')->pluck('id')->first();
        $perfumeCategory = Category::where('name', 'Perfume')->pluck('id')->first();
        $musicCategory = Category::where('name', 'Music')->pluck('id')->first();
        $cheeseCategory = Category::where('name', 'Cheese')->pluck('id')->first();
        $tissueCategory = Category::where('name', 'Tissue')->pluck('id')->first();
        
        Module::create([
            'name' => 'Red wine',
            'description' => 'Module for Red Wines',
            
            'category_id' => $wineCategory,
            'image' => 'rosso.jpg'
        ]);

        Module::create([
            'name' => 'White wine',
            'description' => 'Module for White Wines',
            
            'category_id' => $wineCategory,
            'image' => 'bianco.jpg'
        ]);

        Module::create([
            'name' => 'Chanel Perfumes',
            'description' => 'Module for Chanel Perfumes',
            
            'category_id' => $perfumeCategory,
            'image' => 'chanel_logo.jpg'
        ]);
        
        Module::create([
            'name' => 'Grana cheese',
            'description' => 'Module for Grana Cheese',
            
            'category_id' => $cheeseCategory,
            'image' => 'default.jpg'
        ]);

        Module::create([
            'name' => 'Tissue',
            'description' => 'Module for Tissue Toucher',
            
            'category_id' => $tissueCategory,
            'image' => 'tessuti.jpg'
        ]);

        Module::create([
            'name' => 'Music',
            'description' => 'Module for Music Listener',
            
            'category_id' => $musicCategory,
            'image' => 'note.jpg'
        ]);
    }

}
