<?php

use Illuminate\Database\Seeder;
use ORC\Category;

class CategoriesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Category::create([
                    'name' => 'Wine',                    
        ]);
        
       Category::create([
                    'name' => 'Coffee',                    
        ]);
       
       Category::create([
                    'name' => 'Cheese',                    
        ]);
       
       Category::create([
                    'name' => 'Perfume',                    
        ]);
       
       Category::create([
                    'name' => 'Tissue',                    
        ]);
       
       Category::create([
                    'name' => 'Music',                    
        ]);
    }

}
